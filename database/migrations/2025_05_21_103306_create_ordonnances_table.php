Schema::create('ordonnances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('prestation_id')->constrained()->onDelete('cascade');
    $table->text('contenu');
    $table->timestamps();
});
