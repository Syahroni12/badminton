    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('anggota', function (Blueprint $table) {
                $table->id();
                $table ->string('Nama');
                $table ->string('Nim');
                // $table ->string('Fakultas');
              $table->unsignedBigInteger('id_jurusan');
                $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
                $table->enum('kedudukan', ['ketua', 'wakil', 'bendahara', 'sekretaris', 'anggota']); // Tambahkan kolom ini
                $table ->enum('jenis_kelamin', ['L','P']); 
                $table->unsignedBigInteger('id_user');
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('anggota');
        }
    };
