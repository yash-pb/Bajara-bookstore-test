<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;


class User extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    // Declaration Properties
    public $updateMode, $createMode = false;
    public $search, $email, $status, $userId, $full_name, $mobile_no, $title = "";
    public $users = [];
    public $sortCol = UserModel::SORTCOL;
    public $sortBy = UserModel::SORTBY;
    public $sortCls = UserModel::SORTCLS;
    protected $rules = [
        'full_name' => "required|max:50",
        'email' => "required|email|unique:users,email",
        'mobile_no' => "required|numeric|phone:INTERNATIONAL",
        'status' => "required",
    ];

    // Render Method
    public function render()
    {
        $paginatedData = UserModel::with('books')->where('user_type', 2)
        ->where(function ($query) {
            $query->where('full_name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orWhere('mobile_no', 'LIKE', '%'.$this->search.'%');
        })
        ->orderBy($this->sortCol, $this->sortBy)->paginate(env('PAGINATION_VALUE'))
        ->setPath(route('admin.livewire.users.list'));
        $this->users = $paginatedData->items();
        // dd($this->users);
        return view('livewire.user.user', compact('paginatedData'));
    }

    // Searching method
    public function searchData(){}

    // Soring Logic
    public function sortingData($name)
    {
        $this->sortCol = $name;
        if($this->sortBy == 'asc') {
            $this->sortBy = 'desc';
            $this->sortCls = 'down';
        } else if ($this->sortBy == 'desc') {
            $this->sortBy = 'asc';
            $this->sortCls = 'up';
        } else {
            $this->sortBy = 'asc';
            $this->sortCls = 'up';
        }
    }

    // Create New method
    public function createUsers()
    {
        $this->resetFields();
        $this->createMode = true;
        $this->updateMode = false;
        $this->title = 'Create User';
    }

    // Save data method
    public function storeUser()
    {
        if($this->createMode)
            $this->rules['email'] = "required|email|unique:users,email";
        else
            $this->rules['email'] = 'required|email';

        $this->validate();
        try {
            UserModel::updateOrCreate([
                'id' => $this->userId
            ],[
                'full_name' => $this->full_name,
                'email' => $this->email,
                'mobile_no' => $this->mobile_no,
                'user_type' => 2,
                'status' => $this->status == 'Active' ? 1 : 2,
            ]);
            session()->flash('success','User Data Saved Successfully!!');
            $this->resetFields();
            $this->createMode = false;
            $this->updateMode = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    // Edit Method
    public function editUser($id)
    {
        try {
            $usre = UserModel::findOrFail($id);
            if(!$usre) {
                session()->flash('error','User not found');
            } else {
                $this->userId = $usre->id;
                $this->full_name = $usre->full_name;
                $this->email = $usre->email;
                $this->mobile_no = $usre->mobile_no;
                $this->status = $usre->status;
                $this->updateMode = true;
                $this->title = 'Update User';
            }

        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    // Delete method
    public function deleteUser($id)
    {
        try{
            UserModel::find($id)->delete();
            session()->flash('success',"User Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }

    // Cancel method
    public function cancelUser()
    {
        $this->resetFields();
        $this->updateMode = false;
        $this->createMode = false;
    }

    // Reset field method
    public function resetFields(){
        $this->resetErrorBag();
        $this->full_name = '';
        $this->email = '';
        $this->mobile_no = '';
        $this->userId = '';
        $this->email = '';
        $this->status = '';
    }
}