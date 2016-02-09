<?php
namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\LessonWord;
use App\User;
use Illuminate\Http\Request;
use Session;

class LessonWordController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session()->keep('lessonId');
        session()->keep('maxQuestions');
        session()->keep('questionIndex');
        session()->keep('wordCount');
        session()->keep('lessonName');
    }

    public function index(Request $request)
    {
        $lessonId = session()->get('lessonId');
        if (empty($lessonId)) {
            return redirect('lessons');
        }

        $questions = LessonWord::with('word')->where('lesson_id', $lessonId)->get();
        session()->flash('maxQuestions', count($questions));

        if (empty(session()->get('questionIndex'))) {
            session()->flash('questionIndex', 0);
        } else {
            session()->keep('questionIndex');
        }
        $optionArray = explode(";", $questions[session()->get('questionIndex')]->word->options . ";" .
            $questions[session()->get('questionIndex')]->word->meaning);
        shuffle($optionArray);

        return view('lessons.exam', [
            'user' => $this->user,
            'questions' => $questions,
            'title' => 'Exam',
            'options' => $optionArray,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $wordId = intval($request->input('lesson_word_id'));
            $lessonId = intval(session()->get('lessonId'));
            $lessonWord = LessonWord::findOrFail($wordId);
            $lessonWord->setAnswer($request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_error', 'Your answer cannot be saved. Please try again later.');
        }
        $nextIndex = intval(session()->get('questionIndex')) + 1;
        if ($nextIndex < session()->get('maxQuestions')) {
            session()->flash('questionIndex', $nextIndex);
            return redirect('exam');
        } else {
            session()->flash('questionIndex', $nextIndex); // Add another one to prevent users from going back

            $eventData = [
                'userId' => $this->user->id,
                'activity' => $this->user->name . " learned " . intval(session()->get('questionIndex')) .
                "/" . intval(session()->get('wordCount')) . " in " . session()->get('lessonName'),
                'lessonId' => $lessonId,
                'type' => Activity::WITH_LESSONID,
            ];
            \Event::fire(new ActivityEvent($eventData));

            session()->forget('wordCount');
            session()->forget('lessonName');
            return redirect('result/' . $lessonId);
        }
    }

    public function show($lessonId)
    {
        if (empty($lessonId) || $this->user->lessons()->where('id', $lessonId)->count() == 0) {
            return redirect('lessons'); // Redirect if session variable of lesson id does not exist
        }
        $lesson = Lesson::find($lessonId);
        $lessonWords = LessonWord::with('word')->where('lesson_id', $lessonId)->get();
        return view('lessons.results', [
            'title' => 'Results',
            'category' => $lesson->category->name,
            'lessonWords' => $lessonWords,
            'user' => $this->user,
        ]);
    }
}
