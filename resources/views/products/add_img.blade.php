<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มข้อมูล
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card col-6 offset-3">

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('add_img_to_db') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">ชื่อสินค้า</label>
                            <input type="file" class="form-control" id="product_pic" name="product_pic"
                                accept="image/x-png,image/gif,image/jpeg">

                        </div>
                        <input type="hidden" id="id" name="id" value="{{ $id }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>

                    </form>
                </div>
            </div>
            @if (count($pic) != 0)
                <div class="card col-12 mt-2">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($pic as $key => $item)
                                <div class="col-3">
                                    <img src="{{ asset($item->pic_name) }}" alt="img">

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
