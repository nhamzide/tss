<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product
            <a href="{{ route('addProduct') }}" class="btn btn-primary float-end">+ เพิ่มข้อมูล</a>

        </h2>

    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card" style="">

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 80px;">#</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col" style="width: 200px;">ราคา</th>
                                <th scope="col" style="width: 100px;">รูป</th>
                                <th scope="col" style="width: 100px;">สถานะ</th>
                                <th scope="col" style="width: 150px;">คำสั่ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $key => $value)
                                <tr>
                                    <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td class="text-center">{{ $value->price }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('product/add_img/' . $value->id) }}"
                                            class="btn btn-info">
                                            รูปภาพ
                                        </a>
                                    
                                    </td>
                                    <td class="text-center">

                                        <input id="status_{{ $value->id }}" class="toggle-class" type="checkbox"
                                            value="{{ $value->is_enable }}"
                                            {{ $value->is_enable == 1 ? 'checked' : '' }}
                                            onclick="status({{ $value->id }})">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('product/edit/' . $value->id) }}"
                                            class="btn btn-warning">แก้ไข</a>
                                        <a href="{{ url('product/delete/' . $value->id) }}" class="btn btn-danger"
                                            onclick="return confrim('ยืนยันการลบข้อมูล ?')">ลบ</a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = window.location.hostname;

    function status(id) {
        var status_val = $('#status_' + id).val();

        $.ajax({
            url: "product/status",
            type: "post",
            data: {
                is_enable: status_val,
                id: id
            },
            success: function(result) {
               
            }
        });
    }

</script>
