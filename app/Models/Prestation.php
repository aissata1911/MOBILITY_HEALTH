public function sinistre()
{
    return $this->belongsTo(Sinistre::class);
}

public function ordonnance()
{
    return $this->hasOne(Ordonnance::class);
}
