<?php

namespace Database\Seeders;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;
class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            ['question'=>'これは＿＿＿です。（book）','choice_a'=>'本','choice_b'=>'山','choice_c'=>'川','choice_d'=>'水','correct_choice'=>'A','explanation'=>'本 (hon) means book.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'私＿＿＿学生です。','choice_a'=>'を','choice_b'=>'に','choice_c'=>'は','choice_d'=>'で','correct_choice'=>'C','explanation'=>'は marks the topic of the sentence.','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'水を＿＿＿。（I drink water）','choice_a'=>'食べます','choice_b'=>'見ます','choice_c'=>'飲みます','choice_d'=>'読みます','correct_choice'=>'C','explanation'=>'飲む means to drink.','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'大きい means:','choice_a'=>'Small','choice_b'=>'Big','choice_c'=>'New','choice_d'=>'Old','correct_choice'=>'B','explanation'=>'大きい (ookii) means big.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'今日 means:','choice_a'=>'Yesterday','choice_b'=>'Tomorrow','choice_c'=>'Today','choice_d'=>'Now','correct_choice'=>'C','explanation'=>'今日 (kyou) means today.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'学校へ＿＿＿。（I go to school）','choice_a'=>'行きます','choice_b'=>'来ます','choice_c'=>'帰ります','choice_d'=>'話します','correct_choice'=>'A','explanation'=>'行く means to go.','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'お母さん means:','choice_a'=>'Father','choice_b'=>'Mother','choice_c'=>'Sister','choice_d'=>'Brother','correct_choice'=>'B','explanation'=>'お母さん (okaasan) means mother.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'三時＿＿＿起きます。（at 3 o\'clock）','choice_a'=>'で','choice_b'=>'を','choice_c'=>'が','choice_d'=>'に','correct_choice'=>'D','explanation'=>'に marks a specific point in time.','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'好き means:','choice_a'=>'Dislike','choice_b'=>'Like','choice_c'=>'Busy','choice_d'=>'Difficult','correct_choice'=>'B','explanation'=>'好き (suki) means to like.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'昨日 means:','choice_a'=>'Today','choice_b'=>'Tomorrow','choice_c'=>'Yesterday','choice_d'=>'Next week','correct_choice'=>'C','explanation'=>'昨日 (kinou) means yesterday.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'本を＿＿＿。（I read a book）','choice_a'=>'読みます','choice_b'=>'書きます','choice_c'=>'買います','choice_d'=>'売ります','correct_choice'=>'A','explanation'=>'読む means to read.','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'これは何ですか。答え：＿＿＿です。（It\'s a pen）','choice_a'=>'ペン','choice_b'=>'猫','choice_c'=>'犬','choice_d'=>'花','correct_choice'=>'A','explanation'=>'This is asking \'what is this\' — answer with the object name.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'公園__遊びます。（play at the park）','choice_a'=>'に','choice_b'=>'へ','choice_c'=>'で','choice_d'=>'を','correct_choice'=>'C','explanation'=>'で marks the location where an action happens.','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'忙しい means:','choice_a'=>'Fun','choice_b'=>'Busy','choice_c'=>'Easy','choice_d'=>'Cheap','correct_choice'=>'B','explanation'=>'忙しい (isogashii) means busy.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'食べる → ます形 is:','choice_a'=>'食べます','choice_b'=>'食べる','choice_c'=>'食べた','choice_d'=>'食べて','correct_choice'=>'A','explanation'=>'たべる → たべます (polite present).','level'=>'N5','category'=>'Grammar','status'=>'published'],
            ['question'=>'Potential form of 話す (to speak) is:','choice_a'=>'話せる','choice_b'=>'話した','choice_c'=>'話して','choice_d'=>'話そう','correct_choice'=>'A','explanation'=>'す→せる is the Group 1 potential pattern.','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'食べている means:','choice_a'=>'Will eat','choice_b'=>'Ate','choice_c'=>'Is eating','choice_d'=>'Wants to eat','correct_choice'=>'C','explanation'=>'て + いる shows an ongoing action.','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'経験 means:','choice_a'=>'Experience','choice_b'=>'Environment','choice_c'=>'Economy','choice_d'=>'Explanation','correct_choice'=>'A','explanation'=>'経験 (keiken) means experience.','level'=>'N4','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'安ければ、買います means:','choice_a'=>'I bought it because it was cheap','choice_b'=>'If it is cheap, I will buy it','choice_c'=>'It is not cheap','choice_d'=>'I want to buy something cheap','correct_choice'=>'B','explanation'=>'ば-form expresses a conditional \'if\'.','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'大切 means:','choice_a'=>'Important','choice_b'=>'Necessary','choice_c'=>'Complicated','choice_d'=>'Convenient','correct_choice'=>'A','explanation'=>'大切 (taisetsu) means important.','level'=>'N4','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'宿題を忘れてしまいました means:','choice_a'=>'I will forget my homework','choice_b'=>'I forgot my homework (regrettably)','choice_c'=>'I remembered my homework','choice_d'=>'I never forget homework','correct_choice'=>'B','explanation'=>'て+しまう adds a nuance of regret/completion.','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'友達にプレゼントをもらいました means:','choice_a'=>'I gave a present to my friend','choice_b'=>'My friend gave me a present','choice_c'=>'I received a present from my friend','choice_d'=>'I bought a present for my friend','correct_choice'=>'C','explanation'=>'もらう means to receive from someone.','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'便利 means:','choice_a'=>'Inconvenient','choice_b'=>'Convenient','choice_c'=>'Dangerous','choice_d'=>'Simple','correct_choice'=>'B','explanation'=>'便利 (benri) means convenient.','level'=>'N4','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'Casual/plain past of 行く (to go) is:','choice_a'=>'行った','choice_b'=>'行きます','choice_c'=>'行って','choice_d'=>'行こう','correct_choice'=>'A','explanation'=>'This is the plain past (た-form).','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'駅 means:','choice_a'=>'Airport','choice_b'=>'Bank','choice_c'=>'Station','choice_d'=>'Hospital','correct_choice'=>'C','explanation'=>'駅 (eki) means train station.','level'=>'N4','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'食べたばかりです means:','choice_a'=>'I am about to eat','choice_b'=>'I want to eat','choice_c'=>'I just ate','choice_d'=>'I never eat','correct_choice'=>'C','explanation'=>'～たばかり means \'just did something\'.','level'=>'N3','category'=>'Grammar','status'=>'published'],
            ['question'=>'＿＿＿のに, meaning \'even though\', shows:','choice_a'=>'A reason','choice_b'=>'A contrast/unexpected result','choice_c'=>'A condition','choice_d'=>'A request','correct_choice'=>'B','explanation'=>'のに expresses an unexpected or contrasting result.','level'=>'N3','category'=>'Grammar','status'=>'published'],
            ['question'=>'行くことにしました means:','choice_a'=>'It was decided that someone goes','choice_b'=>'I decided to go','choice_c'=>'I am going now','choice_d'=>'I used to go','correct_choice'=>'B','explanation'=>'～ことにする means \'to decide to do\'.','level'=>'N3','category'=>'Grammar','status'=>'published'],
            ['question'=>'＿＿＿させていただきます is a very polite way to say:','choice_a'=>'Please let me do this','choice_b'=>'Please do this for me','choice_c'=>'I will never do this','choice_d'=>'You must do this','correct_choice'=>'A','explanation'=>'させていただく is a humble causative-permission form.','level'=>'N3','category'=>'Grammar','status'=>'published'],
            ['question'=>'複雑 means:','choice_a'=>'Simple','choice_b'=>'Complicated','choice_c'=>'Convenient','choice_d'=>'Dangerous','correct_choice'=>'B','explanation'=>'複雑 (fukuzatsu) means complicated.','level'=>'N3','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'集まる means:','choice_a'=>'To collect (something)','choice_b'=>'To gather (intransitive)','choice_c'=>'To decide','choice_d'=>'To continue','correct_choice'=>'B','explanation'=>'集まる is the intransitive \'to gather/assemble\'.','level'=>'N3','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'駅で待ちましょう means:','choice_a'=>'Let\'s wait at the station','choice_b'=>'I waited at the station','choice_c'=>'Please wait at the station','choice_d'=>'I will not wait at the station','correct_choice'=>'A','explanation'=>'ましょう is the polite volitional \'let\'s do\'.','level'=>'N4','category'=>'Grammar','status'=>'published'],
            ['question'=>'元気 means:','choice_a'=>'Sick','choice_b'=>'Energetic / healthy','choice_c'=>'Sad','choice_d'=>'Angry','correct_choice'=>'B','explanation'=>'元気 (genki) means energetic or healthy.','level'=>'N4','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'会議 means:','choice_a'=>'Party','choice_b'=>'Meeting','choice_c'=>'Vacation','choice_d'=>'Homework','correct_choice'=>'B','explanation'=>'会議 (kaigi) means meeting.','level'=>'N4','category'=>'Vocabulary','status'=>'published'],
            ['question'=>'高い has two meanings:','choice_a'=>'Cheap and small','choice_b'=>'Expensive and tall','choice_c'=>'New and old','choice_d'=>'Fast and slow','correct_choice'=>'B','explanation'=>'高い can mean both \'expensive\' and \'tall/high\'.','level'=>'N5','category'=>'Vocabulary','status'=>'published'],
        ];

        foreach ($questions as $row) {
            QuizQuestion::firstOrCreate(['question' => $row['question']], $row);
        }
    }
}
