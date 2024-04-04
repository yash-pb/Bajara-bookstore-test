
<h1 class="text-center text-2xl font-bold my-3">{{ $title }}</h1>

<form class="w-full" wire:submit.prevent="storeUser()" action="#" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                Full Name
            </label>
            <input value="{{ $full_name ?? '' }}" wire:model="full_name" id="name" name="full_name" type="text" placeholder="Enter user name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            @error('full_name')
                <p class="error text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full md:w-1/2 px-3">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Mobile Number
                </label>
                <input type="number" value="{{ $mobile_no ?? '' }}" name="mobile_no" wire:model="mobile_no" placeholder="Enter mobile number" class="py-3 px-4 resize-y rounded-md w-full md:resize border border-gray-200 focus:border-gray-500 bg-gray-200 focus:bg-white">
                @error('mobile_no')
                    <p class="error text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>    
    </div>
    <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
            Email
          </label>
          <input name="email" wire:model="email" value="{{ $email }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="Enter email">
          @error('email')
              <p class="error text-red-500 text-xs italic">{{ $message }}</p>
          @enderror
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
            Status
          </label>
          <div class="relative">
            <select name="status" wire:model="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="status">
              <option value="">Select Option</option>
              <option value="Active" {{ $status == 'Active' ? 'selected' : '' }}>Active</option>
              <option value="In-active" {{ $status == 'In-active' ? 'selected' : '' }}>In-Active</option>
            </select>
            @error('status')
              <p class="error text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
          </div>
        </div>
      </div>

    <div class="flex flex-wrap -mx-3 mb-4">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
            Save
        </button>
        <button wire:click.prevent="cancelUser()" type="button" class="flex-shrink-0 bg-gray-500 hover:bg-gray-700 border-gray-500 hover:border-gray-700 text-sm border-4 text-white py-1 px-2 rounded">
            Cancel
        </button>
    </div>
    </div>
</form>