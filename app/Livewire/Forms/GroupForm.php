<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class GroupForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:100', Rule::unique('groups')->ignore($this->id)],
        ];
    }

    public function save(): void
    {
        $this->validate();
        Group::updateOrCreate(
            ['id' => $this->id],
            [
                'name' => $this->name,
            ]
        );
    }

    public function destroy(): void
    {
        Group::find($this->id)->delete();
    }

    public function setGroup(int $id): void
    {
        $city       = Group::find($id);
        $this->name = $city->name;
        $this->id   = $city->id;
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
