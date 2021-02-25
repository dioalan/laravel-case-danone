<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;

use App\Observers\UjiansObserver as Observer;
use Illuminate\Support\Facades\Schema;

class Ujians extends Resources
{
	// protected $rules = array(
 //        'mahasiswa_id' => 'required|integer',
 //        'matkul_id' => 'required|integer',
 //    );

    protected $forms = array(
        [
            [
                'class' => 'col-6',
                'field' => 'mahasiswa_id'
            ],
            [
                'class' => 'col-6',
                'field' => 'matkul_id'
            ],
            [
                'class' => 'col-6',
                'field' => 'date'
            ],
            [
                'class' => 'col-6',
                'field' => 'room_number'
            ],
        ],
    );

    protected $structures = array(
        "id" => [
            'name' => 'id',
            'default' => null,
            'label' => 'ID',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => true,
            'required' => true,
            'type' => 'integer',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ],


        "mahasiswa_id" => [
            'name' => 'mahasiswa_id',
            'default' => null,
            'label' => 'Mahasiswa',
            'display' => true,
            'validation' => [
                'create' => 'required|integer',
                'update' => 'required|integer',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'reference',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Mahasiswa',
            // Options reference
            'reference' => "mahasiswas", // Select2 API endpoint => /api/v1/mahasiswas
            'relationship' => 'mahasiswa', // relationship request datatable
            'option' => [
                'value' => 'id',
                'label' => 'name'
            ]
        ],

        "matkul_id" => [
            'name' => 'matkul_id',
            'default' => null,
            'label' => 'Mata Kuliah',
            'display' => true,
            'validation' => [
                'create' => 'required|integer',
                'update' => 'required|integer',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'reference',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Mata Kuliah',
            // Options reference
            'reference' => "matkuls", // Select2 API endpoint => /api/v1/matkuls
            'relationship' => 'matkul', // relationship request datatable
            'option' => [
                'value' => 'id',
                'label' => 'nama_matakuliah'
            ]
        ],

        "date" => [
            'name' => 'date',
            'default' => null,
            'label' => 'Date',
            'display' => true,
            'validation' => [
                'create' => 'nullable',
                'update' => 'nullable',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'date',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Date',
        ],

        "room_number" => [
            'name' => 'room_number',
            'default' => null,
            'label' => 'Room Number',
            'display' => true,
            'validation' => [
                'create' => 'required|string',
                'update' => 'required|string',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'number',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => '',
        ],


        "created_at" => [
            'name' => 'created_at',
            'default' => null,
            'label' => 'Created At',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => false,
            'required' => false,
            'type' => 'datetime',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ],
        "updated_at" => [
            'name' => 'updated_at',
            'default' => null,
            'label' => 'Updated At',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => false,
            'required' => false,
            'type' => 'datetime',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ],
        "deleted_at" => [
            'name' => 'deleted_at',
            'default' => null,
            'label' => 'Deleted At',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => false,
            'required' => false,
            'type' => 'datetime',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ]
    );

    protected $searchable = array('name');
    protected $casts = [
        'mahasiswa' => 'array',
        'matkul' => 'array',
    ];

    //  OBSERVER
    protected static function boot() {
        parent::boot();
        static::observe(Observer::class);
    }

    public function mahasiswa() {
        return $this->belongsTo('App\Models\Mahasiswas', 'mahasiswa_id', 'id')->withTrashed();
    }

    public function matkul() {
        return $this->belongsTo('App\Models\Matkuls', 'matkul_id', 'id')->withTrashed();
    }
}
