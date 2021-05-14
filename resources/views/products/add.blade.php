<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มข้อมูล
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card col-6 offset-3" >

                <div class="card-body">
                    @if(session("success"))
                       <div class="alert alert-success">{{ session('success') }}</div> 
                    @endif

                    <form action="{{ route('add_to_db') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="product_name" class="form-label">ชื่อสินค้า</label>
                          <input type="text" class="form-control" id="product_name" name="product_name" autocomplete="off" >
                        
                        </div>
                        <div class="mb-3">
                          <label for="product_price" class="form-label">ราคา</label>
                          <input type="number" class="form-control" id="product_price" name="product_price">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                        
                      </form>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>

