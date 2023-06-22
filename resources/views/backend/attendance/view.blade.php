@extends('backend.layout.layout')
@section('content')
<div class="row">
    <h5 class="font-mpb mb-3 text-color-primary">
            <strong>Attendance</strong>
    </h5>

    <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="monthDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #444EFF">
                              Pilih Bulan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="monthDropdown">
                              <a class="dropdown-item" href="#" onclick="selectMonth(0)">Januari</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(1)">Februari</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(2)">Maret</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(3)">April</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(4)">Mei</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(5)">Juni</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(6)">Juli</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(7)">Agustus</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(8)">September</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(9)">October</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(10)">November</a>
                              <a class="dropdown-item" href="#" onclick="selectMonth(11)">Desember</a>
                              <!-- Tambahkan bulan lainnya di sini -->
                            </div>
                          </div>
                    </div>
                    <div class="col d-flex">
                        <button onclick="selectMonth()" type="button" class="btn btn-primary rounded-pill" style="background-color: #444eff; width: 150px">
                        Refresh
                        </button>
                    </div>
                </div>
                <div class="row" id="tableContainer">

                </div>
            </div>
    </div>
</div>

<script>
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var selectedMonthIndex = -1;

    function selectMonth(index) {
      selectedMonthIndex = index;
      generateTable();
    }

    function generateTable() {
      if (selectedMonthIndex !== -1) {
        var tableContainer = document.getElementById("tableContainer");

        // Hapus konten sebelumnya dari kontainer tabel
        tableContainer.innerHTML = "";

        // Buat elemen tabel dengan menggunakan kelas Bootstrap
        var table = document.createElement("table");
        table.classList.add("table", "table-bordered");

        // Buat elemen tbody
        var tableBody = document.createElement("tbody");

        // Buat baris untuk header
        var headerRow = document.createElement("tr");

        // Buat kolom header untuk hari
        var dayHeader = document.createElement("th");
        dayHeader.textContent = "Hari / Tanggal";
        headerRow.appendChild(dayHeader);

        // Tambahkan baris header ke dalam tabel
        tableBody.appendChild(headerRow);

        // Dapatkan jumlah hari dalam bulan yang dipilih
        var selectedMonth = months[selectedMonthIndex];
        var daysInMonth = new Date(new Date().getFullYear(), selectedMonthIndex + 1, 0).getDate();

        // Buat baris dan sel-sel tabel untuk setiap tanggal
        for (var i = 1; i <= daysInMonth; i++) {
          var row = document.createElement("tr");

          // Buat sel untuk hari
          var dayCell = document.createElement("td");
          var day = new Date(new Date().getFullYear(), selectedMonthIndex, i).toLocaleDateString('en-us', { weekday: 'long' });
          dayCell.textContent = day +", "+ i;
          row.append(dayCell);

          // Buat sel untuk tombol
          var buttonCell = document.createElement("td");
          var approveButton = document.createElement("button");
          approveButton.textContent = "Approve";
          approveButton.classList.add("btn", "btn-primary");
          buttonCell.appendChild(approveButton);
          row.appendChild(buttonCell);

          // Tambahkan baris ke dalam tabel
          tableBody.appendChild(row);
        }

        // Tambahkan tbody ke dalam tabel
        table.appendChild(tableBody);

        // Tambahkan tabel ke dalam kontainer tabel
        tableContainer.appendChild(table);
      }
    }
  </script>
@endsection