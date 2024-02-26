<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'name' => 'قسم الجراحة',
            'description' => 'الجراحة هي إحدى التخصصات الطبية التي تعتمد على الإجراءات اليدوية والأدوات التقنية المطبقة على المرضى، وذلك بغرض المعالجة أو التحقق من وجود حالة تلف نسيجي التي قد تحدث نتيجة لبعض الأمراض أو لإصابة ما. ويهدف الإجراء الجراحي إلى تحسين الأداء الوظيفي أو الشكل الظاهري للعضو.'
        ]);
        SectionTranslation::create([
            'locale' => 'en',
            'section_id' => '1',
            'name' => 'Department of Surgery',
            'description' => 'Surgery is a medical specialty that relies on manual procedures and technical tools applied to patients, for the purpose of treating or checking for tissue damage that may occur as a result of some disease or injury. The surgical procedure aims to improve the functional performance or appearance of the organ.',
        ]);
        Section::create([
            'name' => 'قسم العيون',
            'description' => 'هو فرع من الطبّ الذي يتعامل مع أمراض وجراحة العيون والمسالك البصرية، يتضمّن ذلك العين، العصب البصري، الشبكية والجسم الزجاجي والعدسة، القزحية، القرنية، الجفون، والمناطق المحيطة بالعين مثل: الجهاز الدمعي وجفني العين، فطبيب وجراح العيون يُعنَى بمعالجة العينَينِ وما '
        ]);
        SectionTranslation::create([
            'locale' => 'en',
            'section_id' => '2',
            'name' => 'Department of Ophthalmology',
            'description' => 'Ophthalmology is a t  the branch of medicine that deals with diseases and surgery of the eyes and visual tracts, including the eye and nerve',
        ]);
        Section::create([
            'name' => 'قسم المخ والاعصاب',
            'description' => 'هو قسم في مجال الطب يركز على دراسة وفهم الجهاز العصبي والدماغ. يتناول هذا القسم عدة مواضيع تتعلق بالتشريح ووظائف الدماغ والأعصاب، ويشمل أيضًا دراسة الأمراض والاضطرابات التي قد تؤثر على هذا الجهاز.'
        ]);
        SectionTranslation::create([
            'locale' => 'en',
            'section_id' => '3',
            'name' => 'Department of Neurology',
            'description' => 'It is a department in the field of medicine that focuses on the study and understanding of the nervous system and the brain. This section deals with several topics related to the anatomy and functions of the brain and nerves, and also includes the study of diseases and disorders that may affect this system',
        ]);
    }
}
