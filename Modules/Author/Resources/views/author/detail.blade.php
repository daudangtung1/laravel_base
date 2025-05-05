@extends('core::layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Default form</h4>
                <p class="card-description"> Basic form layout </p>
                <form class="forms-sample" action="{{ route('admin.author.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-inputs.input
                        :placeholder="'User name'"
                        :title="'User name'"
                        :name="'user_name'"
                        :value="$author->user_name ?? ''"
                        :id="'user_name'"
                        :type="'text'">
                    </x-inputs.input>

                    <x-inputs.input
                        :placeholder="'Slug'"
                        :title="'Slug'"
                        :name="'slug'"
                        :value="$author->slug ?? ''"
                        :id="'slug'"
                        :type="'text'">
                    </x-inputs.input>

                    <x-inputs.input
                        :placeholder="'Email'"
                        :title="'Email'"
                        :name="'email'"
                        :value="isset($author->user) && $author->user->email ? $author->user->email : ''"
                        :id="'email'"
                        :type="'email'">
                    </x-inputs.input>

                    <x-inputs.input
                        :placeholder="'Password'"
                        :title="'Password'"
                        :name="'password'"
                        :value="isset($author->user) && $author->user->password ? $author->user->password : ''"
                        :id="'password'"
                        :type="'password'">
                    </x-inputs.input>

                    <x-inputs.input
                        :placeholder="'Full name'"
                        :title="'Full Name'"
                        :name="'full_name'"
                        :value="$author->full_name ?? ''"
                        :id="'password'"
                        :type="'text'">
                    </x-inputs.input>

                    <x-inputs.input
                        :placeholder="'birth_day'"
                        :title="'Birth day'"
                        :name="'birth_day'"
                        :value="$author->birth_day ?? ''"
                        :id="'birth_day'"
                        :type="'date'">
                    </x-inputs.input>

                    <x-inputs.upload></x-inputs.upload>
                    <div style="display: flex; margin-top: 10px">
                        <x-buttons.submit>
                            <x-slot name="name">Submit</x-slot>
                        </x-buttons.submit>
                        <a class="btn btn-light" href="{{ URL::previous() }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#user_name').on('change', function() {
        let userName = $('#user_name').val();
        $('#slug').val(createSlug(userName));
    });

    function createSlug(str) {
    const vietnameseMap = {
        'à': 'a', 'á': 'a', 'ạ': 'a', 'ả': 'a', 'ã': 'a',
        'â': 'a', 'ầ': 'a', 'ấ': 'a', 'ậ': 'a', 'ẩ': 'a', 'ẫ': 'a',
        'ă': 'a', 'ằ': 'a', 'ắ': 'a', 'ặ': 'a', 'ẳ': 'a', 'ẵ': 'a',
        'è': 'e', 'é': 'e', 'ẹ': 'e', 'ẻ': 'e', 'ẽ': 'e',
        'ê': 'e', 'ề': 'e', 'ế': 'e', 'ệ': 'e', 'ể': 'e', 'ễ': 'e',
        'ì': 'i', 'í': 'i', 'ị': 'i', 'ỉ': 'i', 'ĩ': 'i',
        'ò': 'o', 'ó': 'o', 'ọ': 'o', 'ỏ': 'o', 'õ': 'o',
        'ô': 'o', 'ồ': 'o', 'ố': 'o', 'ộ': 'o', 'ổ': 'o', 'ỗ': 'o',
        'ơ': 'o', 'ờ': 'o', 'ớ': 'o', 'ợ': 'o', 'ở': 'o', 'ỡ': 'o',
        'ù': 'u', 'ú': 'u', 'ụ': 'u', 'ủ': 'u', 'ũ': 'u',
        'ư': 'u', 'ừ': 'u', 'ứ': 'u', 'ự': 'u', 'ử': 'u', 'ữ': 'u',
        'ỳ': 'y', 'ý': 'y', 'ỵ': 'y', 'ỷ': 'y', 'ỹ': 'y',
        'đ': 'd', 'Đ': 'D'
    };

    return str.toLowerCase()
        .split('')
        .map(char => vietnameseMap[char] || char) // Thay thế ký tự có dấu
        .join('')
        .replace(/[^a-z0-9]+/g, '-') // Thay ký tự không phải chữ cái/số bằng '-'
        .replace(/^-+|-+$/g, ""); // Xóa dấu '-' dư thừa ở đầu và cuối
}
</script>
@endpush