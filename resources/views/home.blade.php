<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body class="bg-light">
    <div class="container mt-5">

      @if (session('store'))
        <div class="alert alert-success">{{ session('store') }}</div>
      @elseif (session('delete'))
        <div class="alert alert-danger">{{ session('delete') }}</div>
      @elseif (session('update'))
        <div class="alert alert-success">{{ session('update') }}</div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Barang</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
          <i class="bi bi-plus-circle me-2"></i>Tambah Barang
        </button>
      </div>

      <h4 class="fw-bold mt-4 mb-3 text-danger"><i class="bi bi-egg-fried me-2"></i>Makanan</h4>
      <div class="row">
        @forelse ($barang->where('kategori', 'Makanan') as $item)
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
              <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title text-primary fw-semibold">{{ $item->name }}</h5>
                <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                <p><strong>Stok:</strong> {{ $item->stok }}</p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-end">
                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#updateData-{{ $item->id }}">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteData-{{ $item->id }}">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="modal fade" id="deleteData-{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hapus Barang</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Apakah yakin ingin menghapus <strong>{{ $item->name }}</strong>?</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="{{ route('barang.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="updateData-{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('barang.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Nama Barang</label>
                      <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Harga</label>
                      <input type="number" class="form-control" name="harga" value="{{ $item->harga }}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Stok</label>
                      <input type="number" class="form-control" name="stok" value="{{ $item->stok }}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Kategori</label>
                      <select class="form-select" name="kategori" required>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Gambar</label>
                      <input type="file" name="gambar" class="form-control" accept="image/*">
                      <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @empty
          <div class="text-center text-muted mb-5">Belum ada data makanan.</div>
        @endforelse
      </div>

      <h4 class="fw-bold mt-5 mb-3 text-primary"><i class="bi bi-cup-straw me-2"></i>Minuman</h4>
      <div class="row">
        @forelse ($barang->where('kategori', 'Minuman') as $item)
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
              <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title text-success fw-semibold">{{ $item->name }}</h5>
                <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                <p><strong>Stok:</strong> {{ $item->stok }}</p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-end">
                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#updateData-{{ $item->id }}">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteData-{{ $item->id }}">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </div>
            </div>
          </div>
        @empty
          <div class="text-center text-muted mb-5">Belum ada data minuman.</div>
        @endforelse
      </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Tambah Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="name" required placeholder="Masukkan nama produk">
              </div>
              <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" required placeholder="Masukkan harga produk">
              </div>
              <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" required placeholder="Masukkan stok produk">
              </div>
              <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select class="form-select" name="kategori" required>
                  <option value="">-- Pilih Kategori --</option>
                  <option value="Makanan">Makanan</option>
                  <option value="Minuman">Minuman</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
