Schema::create('prestations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('sinistre_id')->constrained()->onDelete('cascade');
    $table->string('type');
    $table->text('details')->nullable();
    $table->decimal('prix', 8, 2)->nullable();
    $table->boolean('completee')->default(false);
    $table->timestamps();
});
