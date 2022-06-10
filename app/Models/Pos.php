namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $fillable =[
        'pro_id','pro_name','pro_quantity',
        'product_price','sub_total'
    ];
}
