<?php
/**
 * 学生类导出 xls 类
 * User: jason
 * Date: 2018/9/29
 * Time: 下午6:00
 */

namespace App\Exports;

use App\Models\Province;
use App\Models\ProvinceControlScore;
use App\Repositories\Eloquent\ProvinceRepository;
use Illuminate\Foundation\Console\Presets\None;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use phpDocumentor\Reflection\Types\Null_;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class StudentExport implements WithColumnFormatting, FromQuery
{
    use Exportable;

    private $year;

    public function __construct(int $year = null)
    {
        $this->year = $year;
    }

    public function query()
    {
        if ($this->year != null) {
            return ProvinceControlScore::query()->where('year', $this->year);
        } else {
            return ProvinceControlScore::query();
        }
    }

    /**
     * @return string
     */
    public function title()
    {
        return 'Haha ';
    }

}
