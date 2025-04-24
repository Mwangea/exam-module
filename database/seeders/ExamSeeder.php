<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    private $englishQuestions = [
        'Mathematics' => [
            'What is the result of 5 + 7?' => [12, 10, 8, 13],
            'If x = 3, what is the value of 2x + 4?' => [10, 7, 9, 12],
            'What is the square root of 64?' => [8, 6, 7, 9],
            'Solve for y: 3y - 7 = 14' => [7, 5, 6, 8],
            'What is 15% of 200?' => [30, 15, 20, 25]
        ],
        'Science' => [
            'Which planet is known as the Red Planet?' => ['Mars', 'Venus', 'Jupiter', 'Saturn'],
            'What is the chemical symbol for gold?' => ['Au', 'Ag', 'Fe', 'Hg'],
            'What is the hardest natural substance on Earth?' => ['Diamond', 'Graphite', 'Quartz', 'Topaz'],
            'Which gas do plants absorb from the atmosphere?' => ['Carbon dioxide', 'Oxygen', 'Nitrogen', 'Hydrogen'],
            'What is the main component of the Sun?' => ['Hydrogen', 'Helium', 'Oxygen', 'Carbon']
        ]
    ];

    public function run()
    {
        foreach ($this->englishQuestions as $category => $questions) {
            $exam = Exam::create([
                'title' => $category . ' Proficiency Test',
                'category' => $category,
                'description' => 'Test your knowledge of ' . $category . ' with this comprehensive exam.',
                'duration' => 30
            ]);

            foreach ($questions as $questionText => $answers) {
                $question = Question::create([
                    'exam_id' => $exam->id,
                    'question_text' => $questionText,
                    'explanation' => 'This question tests fundamental knowledge in ' . $category
                ]);

                foreach ($answers as $index => $answerText) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => $answerText,
                        'is_correct' => $index === 0
                    ]);
                }
            }
        }
    }
}
