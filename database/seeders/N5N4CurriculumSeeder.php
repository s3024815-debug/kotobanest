<?php

namespace Database\Seeders;
use App\Models\Kanji;
use App\Models\Lesson;
use App\Models\Vocabulary;
use Illuminate\Database\Seeder;
class N5N4CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $kanji = [
            ['character'=>'一','meaning'=>'one','onyomi'=>'イチ、イツ','kunyomi'=>'ひと(つ)','stroke_count'=>1,'radical'=>'一','level'=>'N5','examples'=>'一つ (ひとつ) - one thing / 一月 (いちがつ) - January','status'=>'published'],
            ['character'=>'二','meaning'=>'two','onyomi'=>'ニ','kunyomi'=>'ふた(つ)','stroke_count'=>2,'radical'=>'二','level'=>'N5','examples'=>'二人 (ふたり) - two people','status'=>'published'],
            ['character'=>'三','meaning'=>'three','onyomi'=>'サン','kunyomi'=>'み(つ)','stroke_count'=>3,'radical'=>'一','level'=>'N5','examples'=>'三月 (さんがつ) - March','status'=>'published'],
            ['character'=>'四','meaning'=>'four','onyomi'=>'シ','kunyomi'=>'よ、よん、よ(つ)','stroke_count'=>5,'radical'=>'囗','level'=>'N5','examples'=>'四時 (よじ) - four o\'clock','status'=>'published'],
            ['character'=>'五','meaning'=>'five','onyomi'=>'ゴ','kunyomi'=>'いつ(つ)','stroke_count'=>4,'radical'=>'二','level'=>'N5','examples'=>'五分 (ごふん) - five minutes','status'=>'published'],
            ['character'=>'六','meaning'=>'six','onyomi'=>'ロク','kunyomi'=>'む(つ)','stroke_count'=>4,'radical'=>'八','level'=>'N5','examples'=>'六月 (ろくがつ) - June','status'=>'published'],
            ['character'=>'七','meaning'=>'seven','onyomi'=>'シチ','kunyomi'=>'なな、なな(つ)','stroke_count'=>2,'radical'=>'一','level'=>'N5','examples'=>'七日 (なのか) - the 7th day','status'=>'published'],
            ['character'=>'八','meaning'=>'eight','onyomi'=>'ハチ','kunyomi'=>'や(つ)','stroke_count'=>2,'radical'=>'八','level'=>'N5','examples'=>'八時 (はちじ) - eight o\'clock','status'=>'published'],
            ['character'=>'九','meaning'=>'nine','onyomi'=>'キュウ、ク','kunyomi'=>'ここの(つ)','stroke_count'=>2,'radical'=>'乙','level'=>'N5','examples'=>'九月 (くがつ) - September','status'=>'published'],
            ['character'=>'十','meaning'=>'ten','onyomi'=>'ジュウ','kunyomi'=>'とお','stroke_count'=>2,'radical'=>'十','level'=>'N5','examples'=>'十分 (じゅっぷん) - ten minutes','status'=>'published'],
            ['character'=>'百','meaning'=>'hundred','onyomi'=>'ヒャク','kunyomi'=>'','stroke_count'=>6,'radical'=>'白','level'=>'N5','examples'=>'百円 (ひゃくえん) - 100 yen','status'=>'published'],
            ['character'=>'千','meaning'=>'thousand','onyomi'=>'セン','kunyomi'=>'ち','stroke_count'=>3,'radical'=>'十','level'=>'N5','examples'=>'千円 (せんえん) - 1000 yen','status'=>'published'],
            ['character'=>'万','meaning'=>'ten-thousand','onyomi'=>'マン、バン','kunyomi'=>'','stroke_count'=>3,'radical'=>'一','level'=>'N5','examples'=>'一万円 (いちまんえん) - 10,000 yen','status'=>'published'],
            ['character'=>'円','meaning'=>'yen / circle','onyomi'=>'エン','kunyomi'=>'まる(い)','stroke_count'=>4,'radical'=>'囗','level'=>'N5','examples'=>'百円 (ひゃくえん) - 100 yen','status'=>'published'],
            ['character'=>'年','meaning'=>'year','onyomi'=>'ネン','kunyomi'=>'とし','stroke_count'=>6,'radical'=>'干','level'=>'N5','examples'=>'今年 (ことし) - this year','status'=>'published'],
            ['character'=>'月','meaning'=>'month / moon','onyomi'=>'ゲツ、ガツ','kunyomi'=>'つき','stroke_count'=>4,'radical'=>'月','level'=>'N5','examples'=>'一月 (いちがつ) - January','status'=>'published'],
            ['character'=>'日','meaning'=>'day / sun','onyomi'=>'ニチ、ジツ','kunyomi'=>'ひ、か','stroke_count'=>4,'radical'=>'日','level'=>'N5','examples'=>'日曜日 (にちようび) - Sunday','status'=>'published'],
            ['character'=>'時','meaning'=>'time / hour','onyomi'=>'ジ','kunyomi'=>'とき','stroke_count'=>10,'radical'=>'日','level'=>'N5','examples'=>'三時 (さんじ) - three o\'clock','status'=>'published'],
            ['character'=>'分','meaning'=>'minute / part','onyomi'=>'フン、ブン','kunyomi'=>'わ(ける)','stroke_count'=>4,'radical'=>'刀','level'=>'N5','examples'=>'五分 (ごふん) - five minutes','status'=>'published'],
            ['character'=>'半','meaning'=>'half','onyomi'=>'ハン','kunyomi'=>'なか(ば)','stroke_count'=>5,'radical'=>'十','level'=>'N5','examples'=>'三時半 (さんじはん) - half past three','status'=>'published'],
            ['character'=>'週','meaning'=>'week','onyomi'=>'シュウ','kunyomi'=>'','stroke_count'=>11,'radical'=>'辵','level'=>'N5','examples'=>'来週 (らいしゅう) - next week','status'=>'published'],
            ['character'=>'今','meaning'=>'now','onyomi'=>'コン','kunyomi'=>'いま','stroke_count'=>4,'radical'=>'人','level'=>'N5','examples'=>'今日 (きょう) - today','status'=>'published'],
            ['character'=>'何','meaning'=>'what','onyomi'=>'カ','kunyomi'=>'なに、なん','stroke_count'=>7,'radical'=>'人','level'=>'N5','examples'=>'これは何ですか - What is this?','status'=>'published'],
            ['character'=>'人','meaning'=>'person','onyomi'=>'ジン、ニン','kunyomi'=>'ひと','stroke_count'=>2,'radical'=>'人','level'=>'N5','examples'=>'日本人 (にほんじん) - Japanese person','status'=>'published'],
            ['character'=>'私','meaning'=>'I / private','onyomi'=>'シ','kunyomi'=>'わたし','stroke_count'=>7,'radical'=>'禾','level'=>'N5','examples'=>'私は学生です - I am a student','status'=>'published'],
            ['character'=>'友','meaning'=>'friend','onyomi'=>'ユウ','kunyomi'=>'とも','stroke_count'=>4,'radical'=>'又','level'=>'N5','examples'=>'友達 (ともだち) - friend','status'=>'published'],
            ['character'=>'本','meaning'=>'book / origin','onyomi'=>'ホン','kunyomi'=>'もと','stroke_count'=>5,'radical'=>'木','level'=>'N5','examples'=>'この本 (ほん) - this book','status'=>'published'],
            ['character'=>'語','meaning'=>'language','onyomi'=>'ゴ','kunyomi'=>'かた(る)','stroke_count'=>14,'radical'=>'言','level'=>'N5','examples'=>'日本語 (にほんご) - Japanese language','status'=>'published'],
            ['character'=>'話','meaning'=>'talk / story','onyomi'=>'ワ','kunyomi'=>'はな(す)','stroke_count'=>13,'radical'=>'言','level'=>'N5','examples'=>'話す (はなす) - to speak','status'=>'published'],
            ['character'=>'食','meaning'=>'eat / food','onyomi'=>'ショク','kunyomi'=>'た(べる)','stroke_count'=>9,'radical'=>'食','level'=>'N5','examples'=>'食べる (たべる) - to eat','status'=>'published'],
            ['character'=>'飲','meaning'=>'drink','onyomi'=>'イン','kunyomi'=>'の(む)','stroke_count'=>12,'radical'=>'食','level'=>'N5','examples'=>'飲む (のむ) - to drink','status'=>'published'],
            ['character'=>'見','meaning'=>'see','onyomi'=>'ケン','kunyomi'=>'み(る)','stroke_count'=>7,'radical'=>'見','level'=>'N5','examples'=>'見る (みる) - to see / watch','status'=>'published'],
            ['character'=>'行','meaning'=>'go','onyomi'=>'コウ、ギョウ','kunyomi'=>'い(く)','stroke_count'=>6,'radical'=>'行','level'=>'N5','examples'=>'学校へ行く - to go to school','status'=>'published'],
            ['character'=>'来','meaning'=>'come','onyomi'=>'ライ','kunyomi'=>'く(る)','stroke_count'=>7,'radical'=>'木','level'=>'N5','examples'=>'日本に来る - to come to Japan','status'=>'published'],
            ['character'=>'大','meaning'=>'big','onyomi'=>'ダイ、タイ','kunyomi'=>'おお(きい)','stroke_count'=>3,'radical'=>'大','level'=>'N5','examples'=>'大きい家 (おおきいいえ) - big house','status'=>'published'],
            ['character'=>'小','meaning'=>'small','onyomi'=>'ショウ','kunyomi'=>'ちい(さい)','stroke_count'=>3,'radical'=>'小','level'=>'N5','examples'=>'小さい猫 (ちいさいねこ) - small cat','status'=>'published'],
            ['character'=>'上','meaning'=>'up / above','onyomi'=>'ジョウ','kunyomi'=>'うえ、あ(げる)','stroke_count'=>3,'radical'=>'一','level'=>'N5','examples'=>'机の上 (つくえのうえ) - on the desk','status'=>'published'],
            ['character'=>'下','meaning'=>'down / below','onyomi'=>'カ、ゲ','kunyomi'=>'した、さ(げる)','stroke_count'=>3,'radical'=>'一','level'=>'N5','examples'=>'木の下 (きのした) - under the tree','status'=>'published'],
            ['character'=>'中','meaning'=>'middle / inside','onyomi'=>'チュウ','kunyomi'=>'なか','stroke_count'=>4,'radical'=>'丨','level'=>'N5','examples'=>'家の中 (いえのなか) - inside the house','status'=>'published'],
            ['character'=>'山','meaning'=>'mountain','onyomi'=>'サン','kunyomi'=>'やま','stroke_count'=>3,'radical'=>'山','level'=>'N5','examples'=>'富士山 (ふじさん) - Mt. Fuji','status'=>'published'],
            ['character'=>'川','meaning'=>'river','onyomi'=>'セン','kunyomi'=>'かわ','stroke_count'=>3,'radical'=>'川','level'=>'N5','examples'=>'川で泳ぐ - to swim in the river','status'=>'published'],
            ['character'=>'口','meaning'=>'mouth','onyomi'=>'コウ','kunyomi'=>'くち','stroke_count'=>3,'radical'=>'口','level'=>'N5','examples'=>'口を開ける - to open one\'s mouth','status'=>'published'],
            ['character'=>'目','meaning'=>'eye','onyomi'=>'モク','kunyomi'=>'め','stroke_count'=>5,'radical'=>'目','level'=>'N5','examples'=>'目が痛い - my eyes hurt','status'=>'published'],
            ['character'=>'耳','meaning'=>'ear','onyomi'=>'ジ','kunyomi'=>'みみ','stroke_count'=>6,'radical'=>'耳','level'=>'N5','examples'=>'耳が大きい - big ears','status'=>'published'],
            ['character'=>'手','meaning'=>'hand','onyomi'=>'シュ','kunyomi'=>'て','stroke_count'=>4,'radical'=>'手','level'=>'N5','examples'=>'手を洗う - to wash hands','status'=>'published'],
            ['character'=>'足','meaning'=>'foot / leg','onyomi'=>'ソク','kunyomi'=>'あし','stroke_count'=>7,'radical'=>'足','level'=>'N5','examples'=>'足が長い - long legs','status'=>'published'],
            ['character'=>'水','meaning'=>'water','onyomi'=>'スイ','kunyomi'=>'みず','stroke_count'=>4,'radical'=>'水','level'=>'N5','examples'=>'水を飲む - to drink water','status'=>'published'],
            ['character'=>'火','meaning'=>'fire','onyomi'=>'カ','kunyomi'=>'ひ','stroke_count'=>4,'radical'=>'火','level'=>'N5','examples'=>'火曜日 (かようび) - Tuesday','status'=>'published'],
            ['character'=>'木','meaning'=>'tree','onyomi'=>'モク、ボク','kunyomi'=>'き','stroke_count'=>4,'radical'=>'木','level'=>'N5','examples'=>'木曜日 (もくようび) - Thursday','status'=>'published'],
            ['character'=>'金','meaning'=>'gold / money','onyomi'=>'キン','kunyomi'=>'かね','stroke_count'=>8,'radical'=>'金','level'=>'N5','examples'=>'お金 (おかね) - money','status'=>'published'],
            ['character'=>'会','meaning'=>'meet','onyomi'=>'カイ','kunyomi'=>'あ(う)','stroke_count'=>6,'radical'=>'人','level'=>'N4','examples'=>'会議 (かいぎ) - meeting','status'=>'published'],
            ['character'=>'社','meaning'=>'company / shrine','onyomi'=>'シャ','kunyomi'=>'やしろ','stroke_count'=>7,'radical'=>'示','level'=>'N4','examples'=>'会社 (かいしゃ) - company','status'=>'published'],
            ['character'=>'電','meaning'=>'electricity','onyomi'=>'デン','kunyomi'=>'','stroke_count'=>13,'radical'=>'雨','level'=>'N4','examples'=>'電話 (でんわ) - telephone','status'=>'published'],
            ['character'=>'車','meaning'=>'car','onyomi'=>'シャ','kunyomi'=>'くるま','stroke_count'=>7,'radical'=>'車','level'=>'N4','examples'=>'電車 (でんしゃ) - train','status'=>'published'],
            ['character'=>'道','meaning'=>'road / way','onyomi'=>'ドウ','kunyomi'=>'みち','stroke_count'=>12,'radical'=>'辵','level'=>'N4','examples'=>'道を歩く - to walk on the road','status'=>'published'],
            ['character'=>'場','meaning'=>'place','onyomi'=>'ジョウ','kunyomi'=>'ば','stroke_count'=>12,'radical'=>'土','level'=>'N4','examples'=>'会場 (かいじょう) - venue','status'=>'published'],
            ['character'=>'立','meaning'=>'stand','onyomi'=>'リツ','kunyomi'=>'た(つ)','stroke_count'=>5,'radical'=>'立','level'=>'N4','examples'=>'立つ (たつ) - to stand','status'=>'published'],
            ['character'=>'生','meaning'=>'life / birth','onyomi'=>'セイ','kunyomi'=>'い(きる)、う(まれる)','stroke_count'=>5,'radical'=>'生','level'=>'N4','examples'=>'先生 (せんせい) - teacher','status'=>'published'],
            ['character'=>'先','meaning'=>'previous / ahead','onyomi'=>'セン','kunyomi'=>'さき','stroke_count'=>6,'radical'=>'儿','level'=>'N4','examples'=>'先週 (せんしゅう) - last week','status'=>'published'],
            ['character'=>'学','meaning'=>'study','onyomi'=>'ガク','kunyomi'=>'まな(ぶ)','stroke_count'=>8,'radical'=>'子','level'=>'N4','examples'=>'学校 (がっこう) - school','status'=>'published'],
            ['character'=>'校','meaning'=>'school','onyomi'=>'コウ','kunyomi'=>'','stroke_count'=>10,'radical'=>'木','level'=>'N4','examples'=>'学校 (がっこう) - school','status'=>'published'],
            ['character'=>'教','meaning'=>'teach','onyomi'=>'キョウ','kunyomi'=>'おし(える)','stroke_count'=>11,'radical'=>'攴','level'=>'N4','examples'=>'教える (おしえる) - to teach','status'=>'published'],
            ['character'=>'室','meaning'=>'room','onyomi'=>'シツ','kunyomi'=>'むろ','stroke_count'=>9,'radical'=>'宀','level'=>'N4','examples'=>'教室 (きょうしつ) - classroom','status'=>'published'],
            ['character'=>'買','meaning'=>'buy','onyomi'=>'バイ','kunyomi'=>'か(う)','stroke_count'=>12,'radical'=>'貝','level'=>'N4','examples'=>'買い物 (かいもの) - shopping','status'=>'published'],
            ['character'=>'売','meaning'=>'sell','onyomi'=>'バイ','kunyomi'=>'う(る)','stroke_count'=>7,'radical'=>'士','level'=>'N4','examples'=>'売る (うる) - to sell','status'=>'published'],
            ['character'=>'読','meaning'=>'read','onyomi'=>'ドク','kunyomi'=>'よ(む)','stroke_count'=>14,'radical'=>'言','level'=>'N4','examples'=>'本を読む - to read a book','status'=>'published'],
            ['character'=>'書','meaning'=>'write','onyomi'=>'ショ','kunyomi'=>'か(く)','stroke_count'=>10,'radical'=>'曰','level'=>'N4','examples'=>'手紙を書く - to write a letter','status'=>'published'],
            ['character'=>'聞','meaning'=>'hear / ask','onyomi'=>'ブン、モン','kunyomi'=>'き(く)','stroke_count'=>14,'radical'=>'耳','level'=>'N4','examples'=>'音楽を聞く - to listen to music','status'=>'published'],
            ['character'=>'言','meaning'=>'say','onyomi'=>'ゲン','kunyomi'=>'い(う)','stroke_count'=>7,'radical'=>'言','level'=>'N4','examples'=>'言葉 (ことば) - word','status'=>'published'],
            ['character'=>'思','meaning'=>'think','onyomi'=>'シ','kunyomi'=>'おも(う)','stroke_count'=>9,'radical'=>'心','level'=>'N4','examples'=>'そう思います - I think so','status'=>'published'],
            ['character'=>'知','meaning'=>'know','onyomi'=>'チ','kunyomi'=>'し(る)','stroke_count'=>8,'radical'=>'矢','level'=>'N4','examples'=>'知っている - to know','status'=>'published'],
            ['character'=>'作','meaning'=>'make','onyomi'=>'サク','kunyomi'=>'つく(る)','stroke_count'=>7,'radical'=>'人','level'=>'N4','examples'=>'料理を作る - to make food','status'=>'published'],
            ['character'=>'使','meaning'=>'use','onyomi'=>'シ','kunyomi'=>'つか(う)','stroke_count'=>8,'radical'=>'人','level'=>'N4','examples'=>'パソコンを使う - to use a computer','status'=>'published'],
            ['character'=>'働','meaning'=>'work','onyomi'=>'ドウ','kunyomi'=>'はたら(く)','stroke_count'=>13,'radical'=>'人','level'=>'N4','examples'=>'会社で働く - to work at a company','status'=>'published'],
            ['character'=>'休','meaning'=>'rest','onyomi'=>'キュウ','kunyomi'=>'やす(む)','stroke_count'=>6,'radical'=>'人','level'=>'N4','examples'=>'学校を休む - to be absent from school','status'=>'published'],
            ['character'=>'持','meaning'=>'hold','onyomi'=>'ジ','kunyomi'=>'も(つ)','stroke_count'=>9,'radical'=>'手','level'=>'N4','examples'=>'荷物を持つ - to hold luggage','status'=>'published'],
            ['character'=>'待','meaning'=>'wait','onyomi'=>'タイ','kunyomi'=>'ま(つ)','stroke_count'=>9,'radical'=>'彳','level'=>'N4','examples'=>'バスを待つ - to wait for the bus','status'=>'published'],
            ['character'=>'出','meaning'=>'exit / go out','onyomi'=>'シュツ','kunyomi'=>'で(る)、だ(す)','stroke_count'=>5,'radical'=>'凵','level'=>'N4','examples'=>'家を出る - to leave home','status'=>'published'],
            ['character'=>'入','meaning'=>'enter','onyomi'=>'ニュウ','kunyomi'=>'はい(る)、い(れる)','stroke_count'=>2,'radical'=>'入','level'=>'N4','examples'=>'部屋に入る - to enter a room','status'=>'published'],
            ['character'=>'開','meaning'=>'open','onyomi'=>'カイ','kunyomi'=>'あ(ける)','stroke_count'=>12,'radical'=>'門','level'=>'N4','examples'=>'ドアを開ける - to open the door','status'=>'published'],
            ['character'=>'閉','meaning'=>'close','onyomi'=>'ヘイ','kunyomi'=>'と(じる)、し(める)','stroke_count'=>11,'radical'=>'門','level'=>'N4','examples'=>'店を閉める - to close the shop','status'=>'published'],
            ['character'=>'好','meaning'=>'like','onyomi'=>'コウ','kunyomi'=>'す(き)','stroke_count'=>6,'radical'=>'女','level'=>'N4','examples'=>'音楽が好きです - I like music','status'=>'published'],
            ['character'=>'悪','meaning'=>'bad','onyomi'=>'アク','kunyomi'=>'わる(い)','stroke_count'=>11,'radical'=>'心','level'=>'N4','examples'=>'天気が悪い - the weather is bad','status'=>'published'],
            ['character'=>'高','meaning'=>'high / expensive','onyomi'=>'コウ','kunyomi'=>'たか(い)','stroke_count'=>10,'radical'=>'高','level'=>'N4','examples'=>'高い山 (たかいやま) - tall mountain','status'=>'published'],
            ['character'=>'安','meaning'=>'cheap / peaceful','onyomi'=>'アン','kunyomi'=>'やす(い)','stroke_count'=>6,'radical'=>'宀','level'=>'N4','examples'=>'安いです - it\'s cheap','status'=>'published'],
            ['character'=>'新','meaning'=>'new','onyomi'=>'シン','kunyomi'=>'あたら(しい)','stroke_count'=>13,'radical'=>'斤','level'=>'N4','examples'=>'新しい車 - new car','status'=>'published'],
            ['character'=>'古','meaning'=>'old','onyomi'=>'コ','kunyomi'=>'ふる(い)','stroke_count'=>5,'radical'=>'口','level'=>'N4','examples'=>'古い本 - old book','status'=>'published'],
            ['character'=>'長','meaning'=>'long / chief','onyomi'=>'チョウ','kunyomi'=>'なが(い)','stroke_count'=>8,'radical'=>'長','level'=>'N4','examples'=>'社長 (しゃちょう) - company president','status'=>'published'],
            ['character'=>'早','meaning'=>'early','onyomi'=>'ソウ','kunyomi'=>'はや(い)','stroke_count'=>6,'radical'=>'日','level'=>'N4','examples'=>'早く起きる - to wake up early','status'=>'published'],
            ['character'=>'多','meaning'=>'many','onyomi'=>'タ','kunyomi'=>'おお(い)','stroke_count'=>6,'radical'=>'夕','level'=>'N4','examples'=>'人が多い - there are many people','status'=>'published'],
            ['character'=>'少','meaning'=>'few / little','onyomi'=>'ショウ','kunyomi'=>'すこ(し)','stroke_count'=>4,'radical'=>'小','level'=>'N4','examples'=>'少し待って - wait a little','status'=>'published'],
            ['character'=>'明','meaning'=>'bright','onyomi'=>'メイ','kunyomi'=>'あか(るい)','stroke_count'=>8,'radical'=>'日','level'=>'N4','examples'=>'明るい部屋 - bright room','status'=>'published'],
            ['character'=>'暗','meaning'=>'dark','onyomi'=>'アン','kunyomi'=>'くら(い)','stroke_count'=>13,'radical'=>'日','level'=>'N4','examples'=>'暗い夜 - dark night','status'=>'published'],
            ['character'=>'天','meaning'=>'heaven / sky','onyomi'=>'テン','kunyomi'=>'あめ','stroke_count'=>4,'radical'=>'大','level'=>'N4','examples'=>'天気 (てんき) - weather','status'=>'published'],
            ['character'=>'気','meaning'=>'spirit / feeling','onyomi'=>'キ','kunyomi'=>'','stroke_count'=>6,'radical'=>'气','level'=>'N4','examples'=>'元気 (げんき) - energetic/healthy','status'=>'published'],
            ['character'=>'病','meaning'=>'illness','onyomi'=>'ビョウ','kunyomi'=>'やまい','stroke_count'=>10,'radical'=>'疒','level'=>'N4','examples'=>'病院 (びょういん) - hospital','status'=>'published'],
            ['character'=>'院','meaning'=>'institution','onyomi'=>'イン','kunyomi'=>'','stroke_count'=>10,'radical'=>'阜','level'=>'N4','examples'=>'病院 (びょういん) - hospital','status'=>'published'],
            ['character'=>'医','meaning'=>'medicine / doctor','onyomi'=>'イ','kunyomi'=>'','stroke_count'=>7,'radical'=>'匚','level'=>'N4','examples'=>'医者 (いしゃ) - doctor','status'=>'published'],
            ['character'=>'駅','meaning'=>'station','onyomi'=>'エキ','kunyomi'=>'','stroke_count'=>14,'radical'=>'馬','level'=>'N4','examples'=>'駅で待つ - to wait at the station','status'=>'published'],
            ['character'=>'洗','meaning'=>'wash','onyomi'=>'セン','kunyomi'=>'あら(う)','stroke_count'=>9,'radical'=>'水','level'=>'N4','examples'=>'手を洗う - to wash hands','status'=>'published'],
        ];
        foreach ($kanji as $row) {
            Kanji::firstOrCreate(['character'=>$row['character'],'level'=>$row['level']], $row);
        }

        $vocabulary = [
            ['word'=>'私','furigana'=>'わたし','meaning_en'=>'I / me','meaning_bn'=>'আমি','example'=>'私は学生です。','level'=>'N5','category'=>'Daily Life','status'=>'published'],
            ['word'=>'あなた','furigana'=>'あなた','meaning_en'=>'you','meaning_bn'=>'তুমি/আপনি','example'=>'あなたの名前は？','level'=>'N5','category'=>'Daily Life','status'=>'published'],
            ['word'=>'先生','furigana'=>'せんせい','meaning_en'=>'teacher','meaning_bn'=>'শিক্ষক','example'=>'先生はやさしいです。','level'=>'N5','category'=>'People','status'=>'published'],
            ['word'=>'学生','furigana'=>'がくせい','meaning_en'=>'student','meaning_bn'=>'ছাত্র/ছাত্রী','example'=>'私は学生です。','level'=>'N5','category'=>'People','status'=>'published'],
            ['word'=>'友達','furigana'=>'ともだち','meaning_en'=>'friend','meaning_bn'=>'বন্ধু','example'=>'友達と遊びます。','level'=>'N5','category'=>'People','status'=>'published'],
            ['word'=>'家族','furigana'=>'かぞく','meaning_en'=>'family','meaning_bn'=>'পরিবার','example'=>'家族は四人です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'お父さん','furigana'=>'おとうさん','meaning_en'=>'father','meaning_bn'=>'বাবা','example'=>'お父さんは会社員です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'お母さん','furigana'=>'おかあさん','meaning_en'=>'mother','meaning_bn'=>'মা','example'=>'お母さんは料理が上手です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'兄','furigana'=>'あに','meaning_en'=>'older brother','meaning_bn'=>'বড় ভাই','example'=>'兄は高校生です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'姉','furigana'=>'あね','meaning_en'=>'older sister','meaning_bn'=>'বড় বোন','example'=>'姉は大学生です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'弟','furigana'=>'おとうと','meaning_en'=>'younger brother','meaning_bn'=>'ছোট ভাই','example'=>'弟は小学生です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'妹','furigana'=>'いもうと','meaning_en'=>'younger sister','meaning_bn'=>'ছোট বোন','example'=>'妹は五歳です。','level'=>'N5','category'=>'Family','status'=>'published'],
            ['word'=>'家','furigana'=>'いえ','meaning_en'=>'house / home','meaning_bn'=>'বাড়ি','example'=>'家に帰ります。','level'=>'N5','category'=>'Daily Life','status'=>'published'],
            ['word'=>'学校','furigana'=>'がっこう','meaning_en'=>'school','meaning_bn'=>'স্কুল','example'=>'学校へ行きます。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'会社','furigana'=>'かいしゃ','meaning_en'=>'company','meaning_bn'=>'কোম্পানি','example'=>'会社で働きます。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'病院','furigana'=>'びょういん','meaning_en'=>'hospital','meaning_bn'=>'হাসপাতাল','example'=>'病院へ行きます。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'駅','furigana'=>'えき','meaning_en'=>'station','meaning_bn'=>'স্টেশন','example'=>'駅で会いましょう。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'図書館','furigana'=>'としょかん','meaning_en'=>'library','meaning_bn'=>'লাইব্রেরি','example'=>'図書館で勉強します。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'公園','furigana'=>'こうえん','meaning_en'=>'park','meaning_bn'=>'পার্ক','example'=>'公園で遊びます。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'店','furigana'=>'みせ','meaning_en'=>'shop / store','meaning_bn'=>'দোকান','example'=>'店で買います。','level'=>'N5','category'=>'Places','status'=>'published'],
            ['word'=>'食べ物','furigana'=>'たべもの','meaning_en'=>'food','meaning_bn'=>'খাবার','example'=>'食べ物が好きです。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'飲み物','furigana'=>'のみもの','meaning_en'=>'drink / beverage','meaning_bn'=>'পানীয়','example'=>'飲み物をください。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'ご飯','furigana'=>'ごはん','meaning_en'=>'rice / meal','meaning_bn'=>'ভাত/খাবার','example'=>'ご飯を食べます。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'水','furigana'=>'みず','meaning_en'=>'water','meaning_bn'=>'পানি','example'=>'水を飲みます。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'お茶','furigana'=>'おちゃ','meaning_en'=>'tea','meaning_bn'=>'চা','example'=>'お茶を飲みます。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'パン','furigana'=>'パン','meaning_en'=>'bread','meaning_bn'=>'রুটি','example'=>'朝パンを食べます。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'魚','furigana'=>'さかな','meaning_en'=>'fish','meaning_bn'=>'মাছ','example'=>'魚が好きです。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'肉','furigana'=>'にく','meaning_en'=>'meat','meaning_bn'=>'মাংস','example'=>'肉を食べます。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'野菜','furigana'=>'やさい','meaning_en'=>'vegetable','meaning_bn'=>'শাকসবজি','example'=>'野菜を食べます。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'果物','furigana'=>'くだもの','meaning_en'=>'fruit','meaning_bn'=>'ফল','example'=>'果物が好きです。','level'=>'N5','category'=>'Food','status'=>'published'],
            ['word'=>'今日','furigana'=>'きょう','meaning_en'=>'today','meaning_bn'=>'আজ','example'=>'今日は暑いです。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'明日','furigana'=>'あした','meaning_en'=>'tomorrow','meaning_bn'=>'আগামীকাল','example'=>'明日会いましょう。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'昨日','furigana'=>'きのう','meaning_en'=>'yesterday','meaning_bn'=>'গতকাল','example'=>'昨日は忙しかったです。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'今','furigana'=>'いま','meaning_en'=>'now','meaning_bn'=>'এখন','example'=>'今何時ですか。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'朝','furigana'=>'あさ','meaning_en'=>'morning','meaning_bn'=>'সকাল','example'=>'朝起きます。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'昼','furigana'=>'ひる','meaning_en'=>'noon / daytime','meaning_bn'=>'দুপুর','example'=>'昼ご飯を食べます。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'夜','furigana'=>'よる','meaning_en'=>'night','meaning_bn'=>'রাত','example'=>'夜寝ます。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'毎日','furigana'=>'まいにち','meaning_en'=>'every day','meaning_bn'=>'প্রতিদিন','example'=>'毎日勉強します。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'時間','furigana'=>'じかん','meaning_en'=>'time / hour','meaning_bn'=>'সময়','example'=>'時間がありません。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'今週','furigana'=>'こんしゅう','meaning_en'=>'this week','meaning_bn'=>'এই সপ্তাহ','example'=>'今週は忙しいです。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'来週','furigana'=>'らいしゅう','meaning_en'=>'next week','meaning_bn'=>'আগামী সপ্তাহ','example'=>'来週旅行します。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'先週','furigana'=>'せんしゅう','meaning_en'=>'last week','meaning_bn'=>'গত সপ্তাহ','example'=>'先週映画を見ました。','level'=>'N5','category'=>'Time','status'=>'published'],
            ['word'=>'大きい','furigana'=>'おおきい','meaning_en'=>'big','meaning_bn'=>'বড়','example'=>'大きい家です。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'小さい','furigana'=>'ちいさい','meaning_en'=>'small','meaning_bn'=>'ছোট','example'=>'小さい猫です。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'新しい','furigana'=>'あたらしい','meaning_en'=>'new','meaning_bn'=>'নতুন','example'=>'新しい車です。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'古い','furigana'=>'ふるい','meaning_en'=>'old','meaning_bn'=>'পুরনো','example'=>'古い本です。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'高い','furigana'=>'たかい','meaning_en'=>'expensive / tall','meaning_bn'=>'দামি / লম্বা','example'=>'高いです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'安い','furigana'=>'やすい','meaning_en'=>'cheap','meaning_bn'=>'সস্তা','example'=>'安いです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'暑い','furigana'=>'あつい','meaning_en'=>'hot (weather)','meaning_bn'=>'গরম','example'=>'今日は暑いです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'寒い','furigana'=>'さむい','meaning_en'=>'cold (weather)','meaning_bn'=>'ঠান্ডা','example'=>'冬は寒いです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'忙しい','furigana'=>'いそがしい','meaning_en'=>'busy','meaning_bn'=>'ব্যস্ত','example'=>'毎日忙しいです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'楽しい','furigana'=>'たのしい','meaning_en'=>'fun / enjoyable','meaning_bn'=>'আনন্দদায়ক','example'=>'旅行は楽しいです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'難しい','furigana'=>'むずかしい','meaning_en'=>'difficult','meaning_bn'=>'কঠিন','example'=>'日本語は難しいです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'易しい','furigana'=>'やさしい','meaning_en'=>'easy','meaning_bn'=>'সহজ','example'=>'この本は易しいです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'きれい','furigana'=>'きれい','meaning_en'=>'pretty / clean','meaning_bn'=>'সুন্দর/পরিষ্কার','example'=>'きれいな花です。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'好き','furigana'=>'すき','meaning_en'=>'like / favorite','meaning_bn'=>'পছন্দ','example'=>'音楽が好きです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'嫌い','furigana'=>'きらい','meaning_en'=>'dislike','meaning_bn'=>'অপছন্দ','example'=>'納豆が嫌いです。','level'=>'N5','category'=>'Adjectives','status'=>'published'],
            ['word'=>'行く','furigana'=>'いく','meaning_en'=>'to go','meaning_bn'=>'যাওয়া','example'=>'学校へ行きます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'来る','furigana'=>'くる','meaning_en'=>'to come','meaning_bn'=>'আসা','example'=>'友達が来ます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'帰る','furigana'=>'かえる','meaning_en'=>'to return / go home','meaning_bn'=>'ফিরে যাওয়া','example'=>'家に帰ります。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'食べる','furigana'=>'たべる','meaning_en'=>'to eat','meaning_bn'=>'খাওয়া','example'=>'ご飯を食べます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'飲む','furigana'=>'のむ','meaning_en'=>'to drink','meaning_bn'=>'পান করা','example'=>'水を飲みます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'見る','furigana'=>'みる','meaning_en'=>'to see / watch','meaning_bn'=>'দেখা','example'=>'映画を見ます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'聞く','furigana'=>'きく','meaning_en'=>'to listen / ask','meaning_bn'=>'শোনা / জিজ্ঞাসা করা','example'=>'音楽を聞きます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'話す','furigana'=>'はなす','meaning_en'=>'to speak','meaning_bn'=>'কথা বলা','example'=>'日本語を話します。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'読む','furigana'=>'よむ','meaning_en'=>'to read','meaning_bn'=>'পড়া','example'=>'本を読みます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'書く','furigana'=>'かく','meaning_en'=>'to write','meaning_bn'=>'লেখা','example'=>'手紙を書きます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'買う','furigana'=>'かう','meaning_en'=>'to buy','meaning_bn'=>'কেনা','example'=>'服を買います。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'売る','furigana'=>'うる','meaning_en'=>'to sell','meaning_bn'=>'বিক্রি করা','example'=>'車を売ります。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'寝る','furigana'=>'ねる','meaning_en'=>'to sleep','meaning_bn'=>'ঘুমানো','example'=>'早く寝ます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'起きる','furigana'=>'おきる','meaning_en'=>'to wake up','meaning_bn'=>'ঘুম থেকে ওঠা','example'=>'朝六時に起きます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'働く','furigana'=>'はたらく','meaning_en'=>'to work','meaning_bn'=>'কাজ করা','example'=>'会社で働きます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'勉強する','furigana'=>'べんきょうする','meaning_en'=>'to study','meaning_bn'=>'পড়াশোনা করা','example'=>'日本語を勉強します。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'休む','furigana'=>'やすむ','meaning_en'=>'to rest / be absent','meaning_bn'=>'বিশ্রাম নেওয়া','example'=>'今日は休みます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'待つ','furigana'=>'まつ','meaning_en'=>'to wait','meaning_bn'=>'অপেক্ষা করা','example'=>'友達を待ちます。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'会う','furigana'=>'あう','meaning_en'=>'to meet','meaning_bn'=>'দেখা করা','example'=>'友達に会います。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'分かる','furigana'=>'わかる','meaning_en'=>'to understand','meaning_bn'=>'বোঝা','example'=>'分かりました。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'使う','furigana'=>'つかう','meaning_en'=>'to use','meaning_bn'=>'ব্যবহার করা','example'=>'パソコンを使います。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'洗う','furigana'=>'あらう','meaning_en'=>'to wash','meaning_bn'=>'ধোয়া','example'=>'手を洗います。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'入る','furigana'=>'はいる','meaning_en'=>'to enter','meaning_bn'=>'ঢোকা','example'=>'部屋に入ります。','level'=>'N5','category'=>'Verbs','status'=>'published'],
            ['word'=>'会議','furigana'=>'かいぎ','meaning_en'=>'meeting','meaning_bn'=>'সভা','example'=>'会議に出ます。','level'=>'N4','category'=>'Work','status'=>'published'],
            ['word'=>'仕事','furigana'=>'しごと','meaning_en'=>'job / work','meaning_bn'=>'কাজ','example'=>'仕事が忙しいです。','level'=>'N4','category'=>'Work','status'=>'published'],
            ['word'=>'経験','furigana'=>'けいけん','meaning_en'=>'experience','meaning_bn'=>'অভিজ্ঞতা','example'=>'いい経験でした。','level'=>'N4','category'=>'Work','status'=>'published'],
            ['word'=>'約束','furigana'=>'やくそく','meaning_en'=>'promise / appointment','meaning_bn'=>'প্রতিশ্রুতি','example'=>'約束を守ります。','level'=>'N4','category'=>'Daily Life','status'=>'published'],
            ['word'=>'説明','furigana'=>'せつめい','meaning_en'=>'explanation','meaning_bn'=>'ব্যাখ্যা','example'=>'説明してください。','level'=>'N4','category'=>'Daily Life','status'=>'published'],
            ['word'=>'経済','furigana'=>'けいざい','meaning_en'=>'economy','meaning_bn'=>'অর্থনীতি','example'=>'経済のニュース。','level'=>'N4','category'=>'Society','status'=>'published'],
            ['word'=>'政治','furigana'=>'せいじ','meaning_en'=>'politics','meaning_bn'=>'রাজনীতি','example'=>'政治に興味があります。','level'=>'N4','category'=>'Society','status'=>'published'],
            ['word'=>'環境','furigana'=>'かんきょう','meaning_en'=>'environment','meaning_bn'=>'পরিবেশ','example'=>'環境を守ります。','level'=>'N4','category'=>'Society','status'=>'published'],
            ['word'=>'文化','furigana'=>'ぶんか','meaning_en'=>'culture','meaning_bn'=>'সংস্কৃতি','example'=>'日本の文化が好きです。','level'=>'N4','category'=>'Society','status'=>'published'],
            ['word'=>'習慣','furigana'=>'しゅうかん','meaning_en'=>'custom / habit','meaning_bn'=>'অভ্যাস','example'=>'いい習慣です。','level'=>'N4','category'=>'Society','status'=>'published'],
            ['word'=>'性格','furigana'=>'せいかく','meaning_en'=>'personality','meaning_bn'=>'স্বভাব','example'=>'明るい性格です。','level'=>'N4','category'=>'People','status'=>'published'],
            ['word'=>'大人','furigana'=>'おとな','meaning_en'=>'adult','meaning_bn'=>'প্রাপ্তবয়স্ক','example'=>'大人になりました。','level'=>'N4','category'=>'People','status'=>'published'],
            ['word'=>'子供','furigana'=>'こども','meaning_en'=>'child','meaning_bn'=>'শিশু','example'=>'子供が三人います。','level'=>'N4','category'=>'People','status'=>'published'],
            ['word'=>'店員','furigana'=>'てんいん','meaning_en'=>'shop staff','meaning_bn'=>'দোকানের কর্মচারী','example'=>'店員に聞きます。','level'=>'N4','category'=>'People','status'=>'published'],
            ['word'=>'運転手','furigana'=>'うんてんしゅ','meaning_en'=>'driver','meaning_bn'=>'চালক','example'=>'運転手さん、お願いします。','level'=>'N4','category'=>'People','status'=>'published'],
            ['word'=>'会社員','furigana'=>'かいしゃいん','meaning_en'=>'company employee','meaning_bn'=>'কোম্পানির কর্মচারী','example'=>'父は会社員です。','level'=>'N4','category'=>'People','status'=>'published'],
            ['word'=>'空港','furigana'=>'くうこう','meaning_en'=>'airport','meaning_bn'=>'বিমানবন্দর','example'=>'空港へ行きます。','level'=>'N4','category'=>'Places','status'=>'published'],
            ['word'=>'大使館','furigana'=>'たいしかん','meaning_en'=>'embassy','meaning_bn'=>'দূতাবাস','example'=>'大使館に行きます。','level'=>'N4','category'=>'Places','status'=>'published'],
            ['word'=>'郵便局','furigana'=>'ゆうびんきょく','meaning_en'=>'post office','meaning_bn'=>'ডাকঘর','example'=>'郵便局で切手を買います。','level'=>'N4','category'=>'Places','status'=>'published'],
            ['word'=>'銀行','furigana'=>'ぎんこう','meaning_en'=>'bank','meaning_bn'=>'ব্যাংক','example'=>'銀行でお金をおろします。','level'=>'N4','category'=>'Places','status'=>'published'],
            ['word'=>'空','furigana'=>'そら','meaning_en'=>'sky','meaning_bn'=>'আকাশ','example'=>'空が青いです。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'海','furigana'=>'うみ','meaning_en'=>'sea','meaning_bn'=>'সমুদ্র','example'=>'海で泳ぎます。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'森','furigana'=>'もり','meaning_en'=>'forest','meaning_bn'=>'বন','example'=>'森を歩きます。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'島','furigana'=>'しま','meaning_en'=>'island','meaning_bn'=>'দ্বীপ','example'=>'小さい島です。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'天気','furigana'=>'てんき','meaning_en'=>'weather','meaning_bn'=>'আবহাওয়া','example'=>'今日の天気はいいです。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'台風','furigana'=>'たいふう','meaning_en'=>'typhoon','meaning_bn'=>'ঘূর্ণিঝড়','example'=>'台風が来ます。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'地震','furigana'=>'じしん','meaning_en'=>'earthquake','meaning_bn'=>'ভূমিকম্প','example'=>'地震がありました。','level'=>'N4','category'=>'Nature','status'=>'published'],
            ['word'=>'怖い','furigana'=>'こわい','meaning_en'=>'scary','meaning_bn'=>'ভয়ঙ্কর','example'=>'怖い映画です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'危ない','furigana'=>'あぶない','meaning_en'=>'dangerous','meaning_bn'=>'বিপজ্জনক','example'=>'危ないですよ。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'大切','furigana'=>'たいせつ','meaning_en'=>'important','meaning_bn'=>'গুরুত্বপূর্ণ','example'=>'大切な人です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'必要','furigana'=>'ひつよう','meaning_en'=>'necessary','meaning_bn'=>'প্রয়োজনীয়','example'=>'必要な物です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'複雑','furigana'=>'ふくざつ','meaning_en'=>'complicated','meaning_bn'=>'জটিল','example'=>'複雑な問題です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'簡単','furigana'=>'かんたん','meaning_en'=>'simple / easy','meaning_bn'=>'সহজ','example'=>'簡単な質問です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'便利','furigana'=>'べんり','meaning_en'=>'convenient','meaning_bn'=>'সুবিধাজনক','example'=>'便利な道具です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'不便','furigana'=>'ふべん','meaning_en'=>'inconvenient','meaning_bn'=>'অসুবিধাজনক','example'=>'不便な場所です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'元気','furigana'=>'げんき','meaning_en'=>'energetic / healthy','meaning_bn'=>'প্রাণবন্ত/সুস্থ','example'=>'元気ですか。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'有名','furigana'=>'ゆうめい','meaning_en'=>'famous','meaning_bn'=>'বিখ্যাত','example'=>'有名な歌手です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'親切','furigana'=>'しんせつ','meaning_en'=>'kind','meaning_bn'=>'দয়ালু','example'=>'親切な人です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'熱心','furigana'=>'ねっしん','meaning_en'=>'enthusiastic','meaning_bn'=>'উৎসাহী','example'=>'熱心に勉強します。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'残念','furigana'=>'ざんねん','meaning_en'=>'regrettable','meaning_bn'=>'দুঃখজনক','example'=>'残念です。','level'=>'N4','category'=>'Adjectives','status'=>'published'],
            ['word'=>'届ける','furigana'=>'とどける','meaning_en'=>'to deliver','meaning_bn'=>'পৌঁছে দেওয়া','example'=>'荷物を届けます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'届く','furigana'=>'とどく','meaning_en'=>'to arrive / reach','meaning_bn'=>'পৌঁছানো','example'=>'手紙が届きました。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'決める','furigana'=>'きめる','meaning_en'=>'to decide','meaning_bn'=>'সিদ্ধান্ত নেওয়া','example'=>'予定を決めます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'決まる','furigana'=>'きまる','meaning_en'=>'to be decided','meaning_bn'=>'সিদ্ধান্ত হওয়া','example'=>'予定が決まりました。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'集める','furigana'=>'あつめる','meaning_en'=>'to collect','meaning_bn'=>'সংগ্রহ করা','example'=>'切手を集めます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'集まる','furigana'=>'あつまる','meaning_en'=>'to gather','meaning_bn'=>'জড়ো হওয়া','example'=>'みんな集まりました。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'始める','furigana'=>'はじめる','meaning_en'=>'to start (something)','meaning_bn'=>'শুরু করা','example'=>'仕事を始めます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'始まる','furigana'=>'はじまる','meaning_en'=>'to start / begin','meaning_bn'=>'শুরু হওয়া','example'=>'授業が始まります。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'終える','furigana'=>'おえる','meaning_en'=>'to finish (something)','meaning_bn'=>'শেষ করা','example'=>'仕事を終えます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'終わる','furigana'=>'おわる','meaning_en'=>'to end / finish','meaning_bn'=>'শেষ হওয়া','example'=>'授業が終わります。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'続ける','furigana'=>'つづける','meaning_en'=>'to continue (something)','meaning_bn'=>'চালিয়ে যাওয়া','example'=>'勉強を続けます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'続く','furigana'=>'つづく','meaning_en'=>'to continue','meaning_bn'=>'চলতে থাকা','example'=>'雨が続きます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'変える','furigana'=>'かえる','meaning_en'=>'to change (something)','meaning_bn'=>'পরিবর্তন করা','example'=>'予定を変えます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'変わる','furigana'=>'かわる','meaning_en'=>'to change','meaning_bn'=>'পরিবর্তিত হওয়া','example'=>'天気が変わりました。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'比べる','furigana'=>'くらべる','meaning_en'=>'to compare','meaning_bn'=>'তুলনা করা','example'=>'二つを比べます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'信じる','furigana'=>'しんじる','meaning_en'=>'to believe','meaning_bn'=>'বিশ্বাস করা','example'=>'彼を信じます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'感じる','furigana'=>'かんじる','meaning_en'=>'to feel','meaning_bn'=>'অনুভব করা','example'=>'寒く感じます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'行われる','furigana'=>'おこなわれる','meaning_en'=>'to be held / conducted','meaning_bn'=>'অনুষ্ঠিত হওয়া','example'=>'会議が行われます。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'案内する','furigana'=>'あんないする','meaning_en'=>'to guide','meaning_bn'=>'পথ দেখানো','example'=>'町を案内します。','level'=>'N4','category'=>'Verbs','status'=>'published'],
            ['word'=>'紹介する','furigana'=>'しょうかいする','meaning_en'=>'to introduce','meaning_bn'=>'পরিচয় করানো','example'=>'友達を紹介します。','level'=>'N4','category'=>'Verbs','status'=>'published'],
        ];
        foreach ($vocabulary as $row) {
            Vocabulary::firstOrCreate(['word'=>$row['word'],'level'=>$row['level']], $row);
        }

        $lessons = [
            ['title'=>'Basic Sentence Structure and the は Particle','category'=>'Grammar','level'=>'N5','content'=>'Japanese basic sentences follow the pattern: Subject + は + Description/Verb.

The particle は (pronounced \'wa\' when used as a particle) marks the topic of the sentence — the thing you are talking about.

Example: 私は学生です。(Watashi wa gakusei desu.) - I am a student.
Here, 私 (watashi, \'I\') is the topic, marked by は, and 学生です (gakusei desu, \'am a student\') describes it.

です (desu) is a polite ending that means roughly \'is/am/are\'. It does not change for singular or plural, or for I/you/he/she.

Practice: どこ (where) + は
Anata wa gakusei desu ka. - Are you a student?
Hai, watashi wa gakusei desu. - Yes, I am a student.

Key point: は marks \'what we are talking about\', not necessarily the grammatical subject. This is one of the first things that feels different from English, so don\'t worry if it takes practice.','status'=>'published'],
            ['title'=>'The が Particle','category'=>'Grammar','level'=>'N5','content'=>'が (ga) marks the grammatical subject of a sentence, often used when introducing new information or answering a \'who/what\' question.

Compare:
私は日本語が好きです。(Watashi wa nihongo ga suki desu.) - I like Japanese.
Here, 私 is the topic (は), and 日本語 (Japanese) is what is liked, marked by が.

が is also used with the verb ある/いる (to exist):
猫がいます。(Neko ga imasu.) - There is a cat.
本があります。(Hon ga arimasu.) - There is a book.

Common mistake for beginners: mixing up は and が. A simple rule of thumb — は sets the topic (\'as for X\'), が points to the specific subject doing/being something within that topic.','status'=>'published'],
            ['title'=>'The を Particle — Direct Objects','category'=>'Grammar','level'=>'N5','content'=>'を (pronounced \'o\') marks the direct object of a verb — the thing that receives the action.

Example: ご飯を食べます。(Gohan o tabemasu.) - I eat rice.
パンを食べる (pan o taberu) - to eat bread
本を読みます (hon o yomimasu) - I read a book

Sentence order in Japanese is usually: Subject(は) + Object(を) + Verb.
私はりんごを食べます。(Watashi wa ringo o tabemasu.) - I eat an apple.

を is also used with verbs of motion leaving a place, like 出る (to exit) or 降りる (to get off):
家を出ます。(Ie o demasu.) - I leave the house.','status'=>'published'],
            ['title'=>'に and で — Time and Place Particles','category'=>'Grammar','level'=>'N5','content'=>'に (ni) is used for specific points in time and destinations.
三時に起きます。(San-ji ni okimasu.) - I wake up at three o\'clock.
学校に行きます。(Gakkou ni ikimasu.) - I go to school.

で (de) is used for the location where an action takes place.
図書館で勉強します。(Toshokan de benkyou shimasu.) - I study at the library.
公園で遊びます。(Kouen de asobimasu.) - I play at the park.

Key difference: に often pairs with existence/arrival (いる, ある, 行く, 来る), while で pairs with actions happening somewhere.
Compare: 家にいます (I am at home) vs. 家で勉強します (I study at home).','status'=>'published'],
            ['title'=>'です / だ — Making Statements','category'=>'Grammar','level'=>'N5','content'=>'です (desu) is the polite copula, roughly meaning \'is/am/are\'.
Positive: 学生です (gakusei desu) - is a student
Negative: 学生じゃありません / 学生ではありません (gakusei ja arimasen) - is not a student

Past tense:
Positive past: 学生でした (gakusei deshita) - was a student
Negative past: 学生じゃありませんでした (gakusei ja arimasen deshita) - was not a student

だ (da) is the plain/casual version of です, used with friends and family, or in casual writing.
学生だ (gakusei da) - is a student (casual)','status'=>'published'],
            ['title'=>'い-Adjectives and な-Adjectives','category'=>'Grammar','level'=>'N5','content'=>'Japanese has two types of adjectives: い-adjectives (end in い) and な-adjectives (need な before a noun).

い-adjective example: 大きい (ookii, big)
大きい家 (ookii ie) - a big house
家は大きいです。(Ie wa ookii desu.) - The house is big.
Negative: 大きくないです (ookikunai desu) - is not big

な-adjective example: きれい (kirei, pretty/clean)
きれいな花 (kirei na hana) - a pretty flower
花はきれいです。(Hana wa kirei desu.) - The flower is pretty.
Negative: きれいじゃないです (kirei ja nai desu) - is not pretty

Tip: the trickiest な-adjectives look like い-adjectives but aren\'t — for example きれい and 有名 (famous) both need な before a noun even though some end in い-like sounds. When in doubt, memorize each adjective\'s type as vocabulary.','status'=>'published'],
            ['title'=>'Verb Groups and the ます Form','category'=>'Grammar','level'=>'N5','content'=>'Japanese verbs fall into three groups: Group 1 (u-verbs), Group 2 (ru-verbs), and Group 3 (irregular: する, 来る).

The ます form is the polite present/future form, used in most everyday polite conversation.
食べる → 食べます (taberu → tabemasu) - to eat
飲む → 飲みます (nomu → nomimasu) - to drink
行く → 行きます (iku → ikimasu) - to go

Negative present: ～ません
食べません (tabemasen) - do not eat
行きません (ikimasen) - do not go

These forms work the same regardless of the subject (I, you, he, she, they) — Japanese verbs don\'t conjugate by person, only by tense and politeness level.','status'=>'published'],
            ['title'=>'Past Tense — ました and でした','category'=>'Grammar','level'=>'N5','content'=>'To talk about the past politely, change ます to ました, and です to でした.

食べます → 食べました (tabemasu → tabemashita) - ate
行きます → 行きました (ikimasu → ikimashita) - went
学生です → 学生でした (gakusei desu → gakusei deshita) - was a student

Negative past: ～ませんでした
食べませんでした (tabemasen deshita) - did not eat

Example dialogue:
昨日何をしましたか。(Kinou nani o shimashita ka.) - What did you do yesterday?
映画を見ました。(Eiga o mimashita.) - I watched a movie.','status'=>'published'],
            ['title'=>'The Plain Form and Dictionary Form','category'=>'Grammar','level'=>'N4','content'=>'So far you\'ve learned the polite ます form. The plain form (also called dictionary form) is used in casual speech, and is the base for many N4 grammar patterns.

Group 1 verbs change their final u-sound to an i-sound for ます, but keep the u-sound in plain form: 飲む (nomu, plain) → 飲みます (nomimasu, polite).
Group 2 verbs drop る and add ます: 食べる (taberu, plain) → 食べます (tabemasu, polite).
Irregular: する→します, 来る(くる)→来ます(きます)

The plain negative form (ない form) is essential for later grammar patterns like ～なければならない.
飲む → 飲まない (nomanai) - do not drink
食べる → 食べない (tabenai) - do not eat
する → しない, 来る → 来ない

Dictionaries and grammar textbooks always list verbs in this dictionary/plain form, so getting comfortable with it unlocks a lot of independent study.','status'=>'published'],
            ['title'=>'た-Form — Plain Past and Connecting Sentences','category'=>'Grammar','level'=>'N4','content'=>'The た-form is the plain past tense, and it\'s also used to connect a list of past actions (similar to how て-form connects present actions).

食べる → 食べた (tabeta) - ate
飲む → 飲んだ (nonda) - drank
行く → 行った (itta) - went

Used for casual past tense:
昨日映画を見た。(Kinou eiga o mita.) - I watched a movie yesterday. (casual)

Also the base for other N4 patterns like ～たことがある (have done before) and ～たり～たりする (doing things like X and Y):
日本に行ったことがあります。(Nihon ni itta koto ga arimasu.) - I have been to Japan.','status'=>'published'],
            ['title'=>'Potential Form — Being Able To Do Something','category'=>'Grammar','level'=>'N4','content'=>'The potential form expresses ability — \'can do something\'.

Group 1: change final u-sound to e-sound + る
飲む → 飲める (nomeru) - can drink
書く → 書ける (kakeru) - can write

Group 2: drop る, add られる
食べる → 食べられる (taberareru) - can eat
見る → 見られる (mirareru) - can see

Irregular: する → できる (dekiru), 来る → 来られる (korareru)

Example: 日本語が話せます。(Nihongo ga hanasemasu.) - I can speak Japanese.
Note: the object often takes が instead of を with potential verbs.','status'=>'published'],
            ['title'=>'Conditional Forms — ば and たら','category'=>'Grammar','level'=>'N4','content'=>'ば (ba) form expresses \'if\': for Group 1 verbs, change the final u-sound to e-sound and add ば. For Group 2, drop る and add れば.
飲む → 飲めば (nomeba) - if (one) drinks
食べる → 食べれば (tabereba) - if (one) eats

たら (tara) form is made from the plain past (た-form) + ら, and is often more casual/flexible than ば.
食べたら (tabetara) - if/when (one) eats
安かったら、買います。(Yasukattara, kaimasu.) - If it\'s cheap, I\'ll buy it.

General usage tip: たら is safe to use in almost all conditional situations, while ば has some restrictions (for example, it\'s often avoided with commands). For N4 level, learning to recognize both is the priority.','status'=>'published'],
            ['title'=>'Volitional Form — Let\'s / I Will','category'=>'Grammar','level'=>'N4','content'=>'The volitional form expresses intention or a suggestion (\'let\'s do X\' or \'I will do X\').

Polite form: verb stem + ましょう
食べましょう (tabemashou) - let\'s eat
行きましょう (ikimashou) - let\'s go

Plain/casual form:
Group 1: change u-sound to o-sound + う: 飲む → 飲もう (nomou)
Group 2: drop る, add よう: 食べる → 食べよう (tabeyou)
Irregular: する → しよう, 来る → 来よう (koyou)

Example: 一緒に映画を見ましょう。(Issho ni eiga o mimashou.) - Let\'s watch a movie together.','status'=>'published'],
            ['title'=>'て-Form + いる — Ongoing Actions and States','category'=>'Grammar','level'=>'N4','content'=>'You already know て-form for connecting actions and making requests. て + いる expresses an ongoing action (progressive) or a resulting state.

Ongoing action: 今、勉強しています。(Ima, benkyou shite imasu.) - I am studying now.

Resulting state (for verbs of change): 結婚しています。(Kekkon shite imasu.) - I am married. (the state resulting from the action of marrying)
窓が開いています。(Mado ga aite imasu.) - The window is open.

This single pattern covers a lot of ground, so pay attention to context to know whether it means \'is doing\' or \'has become/is in the state of\'.','status'=>'published'],
            ['title'=>'て-Form + みる / しまう / おく — Auxiliary Verbs','category'=>'Grammar','level'=>'N4','content'=>'Attaching certain verbs after て-form adds nuance to the main verb.

て + みる: to try doing something
食べてみます。(Tabete mimasu.) - I\'ll try eating it.

て + しまう: to complete something (often with a nuance of regret or finality)
宿題を忘れてしまいました。(Shukudai o wasurete shimaimashita.) - I forgot my homework (unfortunately).

て + おく: to do something in advance / leave something as is for later convenience
予約しておきます。(Yoyaku shite okimasu.) - I\'ll make a reservation (in advance).','status'=>'published'],
            ['title'=>'Giving and Receiving — あげる、くれる、もらう','category'=>'Grammar','level'=>'N4','content'=>'Japanese uses different verbs for giving and receiving depending on who is involved.

あげる (ageru): I/someone give(s) to another person.
私は友達にプレゼントをあげます。(Watashi wa tomodachi ni purezento o agemasu.) - I give a present to my friend.

くれる (kureru): someone gives to me (or someone in my in-group).
友達が私にプレゼントをくれます。(Tomodachi ga watashi ni purezento o kuremasu.) - My friend gives me a present.

もらう (morau): I/someone receive(s) from another person.
私は友達にプレゼントをもらいます。(Watashi wa tomodachi ni purezento o moraimasu.) - I receive a present from my friend.

These same three verbs also attach to て-form to describe favors: 手伝ってもらいました (had someone help me), 教えてくれました (someone taught/explained to me).','status'=>'published'],
        ];
        foreach ($lessons as $row) {
            Lesson::firstOrCreate(['title'=>$row['title'],'level'=>$row['level']], $row);
        }
    }
    public static function n5GrammarLessons(): array
    {
        return [
            ['Basic Sentence Structure and the は Particle', 'Grammar', 'N5', 'Japanese basic sentences follow the pattern: Subject + は + Description/Verb.

The particle は (pronounced \'wa\' when used as a particle) marks the topic of the sentence — the thing you are talking about.

Example: 私は学生です。(Watashi wa gakusei desu.) - I am a student.
Here, 私 (watashi, \'I\') is the topic, marked by は, and 学生です (gakusei desu, \'am a student\') describes it.

です (desu) is a polite ending that means roughly \'is/am/are\'. It does not change for singular or plural, or for I/you/he/she.

Practice: どこ (where) + は
Anata wa gakusei desu ka. - Are you a student?
Hai, watashi wa gakusei desu. - Yes, I am a student.

Key point: は marks \'what we are talking about\', not necessarily the grammatical subject. This is one of the first things that feels different from English, so don\'t worry if it takes practice.'],
            ['The が Particle', 'Grammar', 'N5', 'が (ga) marks the grammatical subject of a sentence, often used when introducing new information or answering a \'who/what\' question.

Compare:
私は日本語が好きです。(Watashi wa nihongo ga suki desu.) - I like Japanese.
Here, 私 is the topic (は), and 日本語 (Japanese) is what is liked, marked by が.

が is also used with the verb ある/いる (to exist):
猫がいます。(Neko ga imasu.) - There is a cat.
本があります。(Hon ga arimasu.) - There is a book.

Common mistake for beginners: mixing up は and が. A simple rule of thumb — は sets the topic (\'as for X\'), が points to the specific subject doing/being something within that topic.'],
            ['The を Particle — Direct Objects', 'Grammar', 'N5', 'を (pronounced \'o\') marks the direct object of a verb — the thing that receives the action.

Example: ご飯を食べます。(Gohan o tabemasu.) - I eat rice.
パンを食べる (pan o taberu) - to eat bread
本を読みます (hon o yomimasu) - I read a book

Sentence order in Japanese is usually: Subject(は) + Object(を) + Verb.
私はりんごを食べます。(Watashi wa ringo o tabemasu.) - I eat an apple.

を is also used with verbs of motion leaving a place, like 出る (to exit) or 降りる (to get off):
家を出ます。(Ie o demasu.) - I leave the house.'],
            ['に and で — Time and Place Particles', 'Grammar', 'N5', 'に (ni) is used for specific points in time and destinations.
三時に起きます。(San-ji ni okimasu.) - I wake up at three o\'clock.
学校に行きます。(Gakkou ni ikimasu.) - I go to school.

で (de) is used for the location where an action takes place.
図書館で勉強します。(Toshokan de benkyou shimasu.) - I study at the library.
公園で遊びます。(Kouen de asobimasu.) - I play at the park.

Key difference: に often pairs with existence/arrival (いる, ある, 行く, 来る), while で pairs with actions happening somewhere.
Compare: 家にいます (I am at home) vs. 家で勉強します (I study at home).'],
            ['です / だ — Making Statements', 'Grammar', 'N5', 'です (desu) is the polite copula, roughly meaning \'is/am/are\'.
Positive: 学生です (gakusei desu) - is a student
Negative: 学生じゃありません / 学生ではありません (gakusei ja arimasen) - is not a student

Past tense:
Positive past: 学生でした (gakusei deshita) - was a student
Negative past: 学生じゃありませんでした (gakusei ja arimasen deshita) - was not a student

だ (da) is the plain/casual version of です, used with friends and family, or in casual writing.
学生だ (gakusei da) - is a student (casual)'],
            ['い-Adjectives and な-Adjectives', 'Grammar', 'N5', 'Japanese has two types of adjectives: い-adjectives (end in い) and な-adjectives (need な before a noun).

い-adjective example: 大きい (ookii, big)
大きい家 (ookii ie) - a big house
家は大きいです。(Ie wa ookii desu.) - The house is big.
Negative: 大きくないです (ookikunai desu) - is not big

な-adjective example: きれい (kirei, pretty/clean)
きれいな花 (kirei na hana) - a pretty flower
花はきれいです。(Hana wa kirei desu.) - The flower is pretty.
Negative: きれいじゃないです (kirei ja nai desu) - is not pretty

Tip: the trickiest な-adjectives look like い-adjectives but aren\'t — for example きれい and 有名 (famous) both need な before a noun even though some end in い-like sounds. When in doubt, memorize each adjective\'s type as vocabulary.'],
            ['Verb Groups and the ます Form', 'Grammar', 'N5', 'Japanese verbs fall into three groups: Group 1 (u-verbs), Group 2 (ru-verbs), and Group 3 (irregular: する, 来る).

The ます form is the polite present/future form, used in most everyday polite conversation.
食べる → 食べます (taberu → tabemasu) - to eat
飲む → 飲みます (nomu → nomimasu) - to drink
行く → 行きます (iku → ikimasu) - to go

Negative present: ～ません
食べません (tabemasen) - do not eat
行きません (ikimasen) - do not go

These forms work the same regardless of the subject (I, you, he, she, they) — Japanese verbs don\'t conjugate by person, only by tense and politeness level.'],
            ['Past Tense — ました and でした', 'Grammar', 'N5', 'To talk about the past politely, change ます to ました, and です to でした.

食べます → 食べました (tabemasu → tabemashita) - ate
行きます → 行きました (ikimasu → ikimashita) - went
学生です → 学生でした (gakusei desu → gakusei deshita) - was a student

Negative past: ～ませんでした
食べませんでした (tabemasen deshita) - did not eat

Example dialogue:
昨日何をしましたか。(Kinou nani o shimashita ka.) - What did you do yesterday?
映画を見ました。(Eiga o mimashita.) - I watched a movie.'],
        ];
    }

    public static function n4GrammarLessons(): array
    {
        return [
            ['The Plain Form and Dictionary Form', 'Grammar', 'N4', 'So far you\'ve learned the polite ます form. The plain form (also called dictionary form) is used in casual speech, and is the base for many N4 grammar patterns.

Group 1 verbs change their final u-sound to an i-sound for ます, but keep the u-sound in plain form: 飲む (nomu, plain) → 飲みます (nomimasu, polite).
Group 2 verbs drop る and add ます: 食べる (taberu, plain) → 食べます (tabemasu, polite).
Irregular: する→します, 来る(くる)→来ます(きます)

The plain negative form (ない form) is essential for later grammar patterns like ～なければならない.
飲む → 飲まない (nomanai) - do not drink
食べる → 食べない (tabenai) - do not eat
する → しない, 来る → 来ない

Dictionaries and grammar textbooks always list verbs in this dictionary/plain form, so getting comfortable with it unlocks a lot of independent study.'],
            ['た-Form — Plain Past and Connecting Sentences', 'Grammar', 'N4', 'The た-form is the plain past tense, and it\'s also used to connect a list of past actions (similar to how て-form connects present actions).

食べる → 食べた (tabeta) - ate
飲む → 飲んだ (nonda) - drank
行く → 行った (itta) - went

Used for casual past tense:
昨日映画を見た。(Kinou eiga o mita.) - I watched a movie yesterday. (casual)

Also the base for other N4 patterns like ～たことがある (have done before) and ～たり～たりする (doing things like X and Y):
日本に行ったことがあります。(Nihon ni itta koto ga arimasu.) - I have been to Japan.'],
            ['Potential Form — Being Able To Do Something', 'Grammar', 'N4', 'The potential form expresses ability — \'can do something\'.

Group 1: change final u-sound to e-sound + る
飲む → 飲める (nomeru) - can drink
書く → 書ける (kakeru) - can write

Group 2: drop る, add られる
食べる → 食べられる (taberareru) - can eat
見る → 見られる (mirareru) - can see

Irregular: する → できる (dekiru), 来る → 来られる (korareru)

Example: 日本語が話せます。(Nihongo ga hanasemasu.) - I can speak Japanese.
Note: the object often takes が instead of を with potential verbs.'],
            ['Conditional Forms — ば and たら', 'Grammar', 'N4', 'ば (ba) form expresses \'if\': for Group 1 verbs, change the final u-sound to e-sound and add ば. For Group 2, drop る and add れば.
飲む → 飲めば (nomeba) - if (one) drinks
食べる → 食べれば (tabereba) - if (one) eats

たら (tara) form is made from the plain past (た-form) + ら, and is often more casual/flexible than ば.
食べたら (tabetara) - if/when (one) eats
安かったら、買います。(Yasukattara, kaimasu.) - If it\'s cheap, I\'ll buy it.

General usage tip: たら is safe to use in almost all conditional situations, while ば has some restrictions (for example, it\'s often avoided with commands). For N4 level, learning to recognize both is the priority.'],
            ['Volitional Form — Let\'s / I Will', 'Grammar', 'N4', 'The volitional form expresses intention or a suggestion (\'let\'s do X\' or \'I will do X\').

Polite form: verb stem + ましょう
食べましょう (tabemashou) - let\'s eat
行きましょう (ikimashou) - let\'s go

Plain/casual form:
Group 1: change u-sound to o-sound + う: 飲む → 飲もう (nomou)
Group 2: drop る, add よう: 食べる → 食べよう (tabeyou)
Irregular: する → しよう, 来る → 来よう (koyou)

Example: 一緒に映画を見ましょう。(Issho ni eiga o mimashou.) - Let\'s watch a movie together.'],
            ['て-Form + いる — Ongoing Actions and States', 'Grammar', 'N4', 'You already know て-form for connecting actions and making requests. て + いる expresses an ongoing action (progressive) or a resulting state.

Ongoing action: 今、勉強しています。(Ima, benkyou shite imasu.) - I am studying now.

Resulting state (for verbs of change): 結婚しています。(Kekkon shite imasu.) - I am married. (the state resulting from the action of marrying)
窓が開いています。(Mado ga aite imasu.) - The window is open.

This single pattern covers a lot of ground, so pay attention to context to know whether it means \'is doing\' or \'has become/is in the state of\'.'],
            ['て-Form + みる / しまう / おく — Auxiliary Verbs', 'Grammar', 'N4', 'Attaching certain verbs after て-form adds nuance to the main verb.

て + みる: to try doing something
食べてみます。(Tabete mimasu.) - I\'ll try eating it.

て + しまう: to complete something (often with a nuance of regret or finality)
宿題を忘れてしまいました。(Shukudai o wasurete shimaimashita.) - I forgot my homework (unfortunately).

て + おく: to do something in advance / leave something as is for later convenience
予約しておきます。(Yoyaku shite okimasu.) - I\'ll make a reservation (in advance).'],
            ['Giving and Receiving — あげる、くれる、もらう', 'Grammar', 'N4', 'Japanese uses different verbs for giving and receiving depending on who is involved.

あげる (ageru): I/someone give(s) to another person.
私は友達にプレゼントをあげます。(Watashi wa tomodachi ni purezento o agemasu.) - I give a present to my friend.

くれる (kureru): someone gives to me (or someone in my in-group).
友達が私にプレゼントをくれます。(Tomodachi ga watashi ni purezento o kuremasu.) - My friend gives me a present.

もらう (morau): I/someone receive(s) from another person.
私は友達にプレゼントをもらいます。(Watashi wa tomodachi ni purezento o moraimasu.) - I receive a present from my friend.

These same three verbs also attach to て-form to describe favors: 手伝ってもらいました (had someone help me), 教えてくれました (someone taught/explained to me).'],
        ];
    }
}
