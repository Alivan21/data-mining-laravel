<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-2">
      <a href="{{ route('penjualan.index') }}" class="text-gray-400 hover:text-gray-500">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Tambah Data Penjualan') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div
          class="flex flex-col items-start justify-between gap-2 border-b border-gray-200 bg-white px-4 py-3 sm:px-6 lg:flex-row lg:items-center lg:gap-0">
          <div class="flex flex-col">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
              Form Tambah Data Penjualan
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
              Form untuk menambahkan data penjualan baru
            </p>
          </div>
        </div>
        <form method="POST" action="{{ route('penjualan.store') }}" class="mx-auto p-4 sm:px-6">
          @csrf
          <div class="mb-5">
            <label for="no_faktur" class="mb-2 block text-sm font-medium text-gray-900">
              No Faktur
            </label>
            <input type="text" readonly id="no_faktur" name="no_faktur"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
              value="{{ $noFaktur }}" required />
          </div>
          <div class="my-5 flex gap-5 items-end" id="barang-container[0]">
            <div class="flex-1">
              <label for="barang[0]" class="mb-2 block text-sm font-medium text-gray-900">
                Barang
              </label>
              <select id="barang[0]" name="barang_id[0]"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                required>
                <option value="" disabled selected>Pilih Barang</option>
                @foreach ($semuaBarang as $barang)
                  <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="flex-1">
              <label for="qty[0]" class="mb-2 block text-sm font-medium text-gray-900">
                Qty
              </label>
              <input type="number" id="qty[0]" name="qty[0]" min="50"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                required />
            </div>
            <button type="button" name="add-barang" id="add-barang"
              class="flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-700 text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
              <i class="fa-solid fa-circle-plus"></i>
            </button>
          </div>
          <div class="flex">
            <button type="submit"
              class="w-full rounded-lg bg-indigo-700 px-8 py-2.5 text-center text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    let i = 0;
    $("#add-barang").click(function() {
      i++;
      $("#add-barang").parent().after(`
        <div class="my-5 flex gap-5 items-end" id="barang-container[${i}]">
          <div class="flex-1">
            <label for="barang[${i}]" class="mb-2 block text-sm font-medium text-gray-900">
              Barang
            </label>
            <select id="barang[${i}]" name="barang_id[${i}]"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
              required>
              <option value="" disabled selected>Pilih Barang</option>
              @foreach ($semuaBarang as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="flex-1">
            <label for="qty[${i}]" class="mb-2 block text-sm font-medium text-gray-900">
              Qty
            </label>
            <input type="number" id="qty[${i}]" name="qty[${i}]"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
              required />
          </div>
          <button type="button" name="remove-barang" id="remove-barang"
            class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-700 text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">
            <i class="fa-solid fa-circle-xmark"></i>
          </button>
        </div>
      `);
    });
    $(document).on("click", "#remove-barang", function() {
      $(this).closest("div").remove();
    });
  </script>
</x-app-layout>
