<?php

namespace App\Livewire\Dashboard\Group;

use App\Events\CreateInvoice;
use App\Models\Doctor;
use App\Models\Group;
use App\Models\Service;
use App\Notifications\CreateGroupInvoice;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateGroup extends Component
{
    public $GroupsItems = [];
    public $discount_value = 0;
    public $taxes = 17;
    #[Validate('required|unique:group_translations', onUpdate: false)]
    public $name = '';
    public $notes;
    public $ServiceSaved = false;
    public $showTable = true;
    public $updateMode = false;
    public $group_id;
    public $ServiceUpdated = false;
    protected $listeners = ['refreshData' => '$refresh'];



    public function render()
    {
        $total = 0;
        foreach ($this->GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }
        return view('Dashboard.group.create-group', [
            'groups' => Group::all(),
            'subtotal' => $Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'total' => $Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100),
            'allServices'=> Service::where('status', '1')->get(),        ]);
    }

    // $this->ServiceSaved = false;
    // }
    public function addService()
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                session()->flash('error', 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.');
                return;
            }
        }

        $this->GroupsItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];
    }
    public function saveService($index)
    {
        if ($this->GroupsItems[$index]['quantity'] > 0) {
            $service = Service::findOrFail($this->GroupsItems[$index]['service_id']);
            $this->GroupsItems[$index]['service_name'] = $service->name;
            $this->GroupsItems[$index]['service_price'] = $service->price;
            $this->GroupsItems[$index]['is_saved'] = true;
        }
        session()->flash('error', 'at lest one quantity');
    }
    public function editService($index)
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                session()->flash('errorEdit', 'This line must be saved before editing another.');
                return;
            }
        }

        $this->GroupsItems[$index]['is_saved'] = false;
    }



    public function removeService($index)
    {
        unset($this->GroupsItems[$index]);
        $this->GroupsItems = array_values($this->GroupsItems);
    }

    public function saveGroup()
    {
        if ($this->updateMode) {
            // $this->validate();
            $Groups = Group::find($this->group_id);
            $total = 0;
            foreach ($this->GroupsItems as $groupItem) {
                if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                    // الاجمالي قبل الخصم
                    $total += $groupItem['service_price'] * $groupItem['quantity'];
                }
            }
            foreach ($this->GroupsItems as $key => $groupItem) {
                if (!$groupItem['is_saved']) {
                    session()->flash('errorEdit', 'This line must be saved before editing another.');
                    return;
                }
            }
            //الاجمالي قبل الخصم
            $Groups->total_before_discount = $total;
            // قيمة الخصم
            $Groups->discount_value = $this->discount_value;
            // الاجمالي بعد الخصم
            $Groups->total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
            //  نسبة الضريبة
            $Groups->tax_rate = $this->taxes;
            // الاجمالي + الضريبة
            $Groups->total_with_tax = $Groups->total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
            $Groups->save();
            // حفظ الترجمة
            $Groups->name = $this->name;
            $Groups->notes = $this->notes;
            $Groups->save();
            // حفظ العلاقة

            foreach ($this->GroupsItems as $GroupsItem) {
                // تحقق من وجود العلاقة بين المجموعة والخدمة
                $existingService = $Groups->services()->findOrFail($GroupsItem['service_id']);

                if (!$existingService) {
                    // إذا لم تكن العلاقة موجودة، يتم إضافتها
                    $Groups->services()->attach($GroupsItem['service_id'], ['quantity' => $GroupsItem['quantity']]);
                } else {
                    // إذا كانت العلاقة موجودة، يمكنك تحديث الكمية إذا كان ذلك ضروريًا
                    $existingService->pivot->quantity = $GroupsItem['quantity'];
                    $existingService->pivot->save();
                }
            }
            session()->flash('saved',);
            $this->showTable = true;
        } else {

            $this->validate();
            $Groups = new Group();
            $total = 0;

            foreach ($this->GroupsItems as $groupItem) {
                if ($groupItem['is_saved']) {
                    // الاجمالي قبل الخصم
                    $total += $groupItem['service_price'] * $groupItem['quantity'];
                }
            }
            if (empty($this->GroupsItems)) {
                session()->flash('servicesCountError', 'يجب علي الأقل اختيار خدمة واحدة');
            } else {
                foreach ($this->GroupsItems as $key => $groupItem) {
                    if (!$groupItem['is_saved']) {
                        session()->flash('errorEdit', 'This line must be saved before editing another.');
                        return;
                    }
                }
                if ($this->taxes > 0) {

                    //الاجمالي قبل الخصم
                    $Groups->Total_before_discount = $total;
                    // قيمة الخصم
                    $Groups->discount_value = $this->discount_value;
                    // الاجمالي بعد الخصم
                    $Groups->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
                    //  نسبة الضريبة
                    $Groups->tax_rate = $this->taxes;
                    // الاجمالي + الضريبة
                    $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);

                    // حفظ الترجمة
                    $Groups->name = $this->name;
                    $Groups->notes = $this->notes;
                    $Groups->save();
                    foreach ($this->GroupsItems as $GroupsItem) {
                        // تحقق من وجود العلاقة بين المجموعة والخدمة
                        $existingService = $Groups->services()->find($GroupsItem['service_id']);

                        if (!$existingService) {
                            // إذا لم تكن العلاقة موجودة، يتم إضافتها
                            $Groups->services()->attach($GroupsItem['service_id'], ['quantity' => $GroupsItem['quantity']]);
                        } else {
                            // إذا كانت العلاقة موجودة، يمكنك تحديث الكمية إذا كان ذلك ضروريًا
                            $existingService->pivot->quantity = $GroupsItem['quantity'];
                            $existingService->pivot->save();
                        }
                    }

                    // $users = Doctor::all();
                    // Notification::send($users, new CreateGroupInvoice($this->name, $Groups->id));
                    $this->reset('GroupsItems', 'name', 'notes');
                    $this->discount_value = 0;
                    $this->showTable = true;
                    $this->ServiceSaved = true;
                    // session()->flash('saved', 'saved');

                } else {
                    session()->flash('taxesError', 'error');
                }

                // حفظ العلاقة
            }
        }
    }
    public function showFormAdd()
    {
        $this->showTable = false;
    }
    public function edit($id)
    {

        $this->updateMode = true;
        $this->showTable = false;
        $group = Group::findOrFail($id);
        $this->group_id = $id;
        $this->reset('GroupsItems', 'name', 'notes');
        $this->name = $group->name;
        $this->notes = $group->notes;
        $this->discount_value = intval($group->discount_value);
        $this->taxes = intval($group->tax_rate);
        foreach ($group->services as $service) {
            $this->GroupsItems[] = [
                'service_id' => $service->id,
                'service_name' => $service->name,
                'service_price' => $service->price,
                'is_saved' => true,
                'quantity' => $service->pivot->quantity,

            ];
        }
    }

    public function delete($id)
    {
        Group::findOrFail($id)->delete();
        return to_route('Add_GroupServices');
    }
}
