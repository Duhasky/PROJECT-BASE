<?php

namespace App\Livewire\Forms;

use App\Models\People;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class PeopleForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    public ?string $surname = '';

    public ?string $date_birth = null;

    public ?string $name_mother = '';

    public ?int $city_id;

    public ?int $group_id;

    public ?string $description = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:255', 'min:3'],
            'surname'     => ['required', 'string', 'max:255', 'min:3'],
            'date_birth'  => ['required', 'date'],
            'name_mother' => ['required', 'string', 'max:255', 'min:3'],
            'city_id'     => ['exists:cities,id', 'integer', 'required', 'min:1'],
            'group_id'    => ['required', 'exists:groups,id', 'integer'],
            'description' => ['required', 'string', 'max:255', 'min:10'],
            // 'photos'    => ['image', 'max:20480'],
        ];
    }

    public function save(): People
    {
        $this->validate();
        $people = People::updateOrCreate(
            ['id' => $this->id],
            [
                'name'        => $this->name,
                'surname'     => $this->surname,
                'date_birth'  => $this->date_birth,
                'name_mother' => $this->name_mother,
                'city_id'     => $this->city_id,
                'description' => $this->description,
                'group_id'    => $this->group_id,
            ]
        );

        return $people;
    }

    public function setPeople(int $id): void
    {
        $people            = People::find($id);
        $this->id          = $people->id;
        $this->name        = $people->name;
        $this->surname     = $people->surname;
        $this->date_birth  = $people->date_birth;
        $this->name_mother = $people->name_mother;
        $this->city_id     = $people->city_id;
        $this->description = $people->description;
        $this->group_id    = $people->group_id;
    }

    public function destroy(): void
    {
        People::find($this->id)->delete();
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
