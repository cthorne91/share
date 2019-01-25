<?php

namespace App\Commands\Traits;

use Spatie\Emoji\Emoji;

trait LogsMissing
{
    public function logMissing($name)
    {
        return $this->info($name . " doesn't exist " . Emoji::eye() . ' ' . Emoji::magnifyingGlassTiltedRight());
    }
}
