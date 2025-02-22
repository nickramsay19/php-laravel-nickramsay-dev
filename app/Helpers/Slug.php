<?php
use Illuminate\Support\Str;

function slug(string $name): string {
    return Str::slug(Str::words($name, 5));
}