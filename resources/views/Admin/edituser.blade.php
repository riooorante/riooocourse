@extends('Admin/admin')
@section('Subcontent')
<div class="w-100 h-100">

    <h1 class="flex justify-center items-center m-5">Update Your Profile</h1>
    <div class="w-96 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        
        <form method="POST" class="max-w-400 max-h-800 " action="{{route('admin-user-update', ['id' => $data[0]->id])}}">
            @method("PUT")
            @csrf
        
            <div class="mb-4">
                <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your ID</label>
                <input type="text" id="id" name="id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Id" value="<?=  $data[0]->id?>" readonly>
            </div>
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Name" value="<?=  $data[0]->name ?>" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                <input type="text" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Email" value="<?=  $data[0]->email ?>" required>
            </div>
            
            <div class="flex items-start mb-6">
            <div class="flex items-center h-5">
                
            </div>
           
            </div>
            <div class="flex items-center  justify-center">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </div>
            
        </form>
    </div>
    
</div>
@endsection


