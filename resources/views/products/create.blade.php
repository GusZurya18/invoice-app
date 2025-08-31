<x-app-layout>
<x-slot name="header">
<h2>Tambah Product</h2>
</x-slot>

<div class="py-12">
<div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white shadow p-6 rounded-lg">

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label>Nama Product</label>
            <input type="text" name="name" class="w-full border px-3 py-2" value="{{ old('name') }}" required>
        </div>

        <div class="mb-4">
            <label>Deskripsi</label>
            <textarea name="description" class="w-full border px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label>Category</label>
            <select name="category_id" class="w-full border px-3 py-2" required>
                <option value="">-- Pilih Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Harga Satuan</label>
            <input type="number" name="price" step="0.01" class="w-full border px-3 py-2" value="{{ old('price') }}" required>
        </div>

        <div class="mb-4">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control" required>
        </div>


        <div class="mb-4">
            <label>Foto Product</label>
            <div id="drop-area" class="border-dashed border-2 border-gray-400 p-6 text-center cursor-pointer">
                <p>Drag & Drop foto di sini atau klik untuk pilih file</p>
                <input type="file" name="photo" id="fileElem" accept="image/*" class="hidden">
                <img id="preview" class="mx-auto mt-4 max-h-48 hidden">
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>

</div>
</div>
</div>

<script>
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const preview = document.getElementById('preview');

dropArea.addEventListener('click', () => fileInput.click());
dropArea.addEventListener('dragover', (e) => { e.preventDefault(); dropArea.classList.add('bg-gray-100'); });
dropArea.addEventListener('dragleave', () => dropArea.classList.remove('bg-gray-100'));
dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('bg-gray-100');
    const files = e.dataTransfer.files;
    if(files.length > 0){
        fileInput.files = files;
        showPreview(files[0]);
    }
});
fileInput.addEventListener('change', () => { if(fileInput.files.length>0) showPreview(fileInput.files[0]); });

function showPreview(file){
    const reader = new FileReader();
    reader.onload = (e) => { preview.src = e.target.result; preview.classList.remove('hidden'); }
    reader.readAsDataURL(file);
}
</script>
</x-app-layout>
