Schema::create('sinistres', function (Blueprint $table) {
    $table->id();
    $table->string('numero_dossier')->unique();
    $table->string('patient_nom');
    $table->date('date_declaration');
    $table->text('description')->nullable();
    $table->timestamps();
});
