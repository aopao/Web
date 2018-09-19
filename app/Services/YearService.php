<?php
/**
 * 添加数据所需年份生成器
 * User: jason
 * Date: 2018/9/17
 * Time: 上午9:36
 */

namespace App\Services;

class YearService
{
    private $years;

    private $start_year = null;

    private $end_year = null;

    public function __construct()
    {
        $this->start_year = config('admin.start_year');
        $this->end_year = date('Y', time());
        $this->getAllYears();
    }

    /**
     * 生成最近几年的Options年份
     */
    public function getAllYears()
    {
        for ($this->start_year; $this->start_year <= $this->end_year; $this->start_year++) {
            $this->years[] = $this->start_year;
        }
    }

    /**
     * 生成最近几年的Options年份
     *
     * @param null $year
     * @return null|string
     */
    public function getAllYearsOptions($year = null)
    {

        $option = null;
        $selected = null;

        foreach ($this->years as $value) {
            if ($year == null) {
                $selected = $value == date('Y', time()) ? 'selected' : '';
            } else {
                $selected = $value == $year ? 'selected' : '';
            }

            $option .= "<option $selected value=\"".$value."\">".$value."</option>";
        }

        return $option;
    }
}