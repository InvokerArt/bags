<?php

namespace App\Models\Faqs;

use Illuminate\Database\Eloquent\Model;
use App\Models\Faqs\Traits\Attribute\FaqAttribute;

class Faq extends Model
{
    use FaqAttribute;
}
