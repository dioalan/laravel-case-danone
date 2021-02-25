<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Observers\MatkulsObserver as Observer;
use Illuminate\Support\Facades\Schema;



class Matkuls extends Resources
{
    protected $rules = array(
        'mahasiswa_id' => 'required|integer',
        'nama_matakuliah' => 'required|string',
    );

    protected $forms = array(
        [
            [
                'class' => 'col-2',
                'field' => 'mahasiswa_id'
            ],
            [
                'class' => 'col-6',
                'field' => 'nama_matakuliah'
            ]
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

        "nama_matakuliah" => [
            'name' => 'nama_matakuliah',
            'default' => null,
            'label' => 'Nama Matakuliah',
            'display' => true,
            'validation' => [
                'create' => 'required|string',
                'update' => 'required|string',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'text',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Nama Matakuliah',
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

    // protected $searchable = array('name', 'isocode');
    protected $casts = [
        'mahasiswa' => 'array',
    ];

    //  OBSERVER
    protected static function boot() {
        parent::boot();
        static::observe(Observer::class);
    }

    public function mahasiswa() {
        return $this->belongsTo('App\Models\Mahasiswas', 'mahasiswa_id', 'id')->withTrashed();
    }

    public function ujians() {
        return $this->hasMany('App\Models\Ujians', 'matkul_id', 'id')->withTrashed();
    }

}
