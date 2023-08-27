<?php

namespace App\Models;

use CodeIgniter\Model;

class Expense extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'amount', 'description', 'expense_date'];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function user()
    {
        $userModel = model('App\Models\User');
        return $userModel->where('id', $this->user_id);
    }

    public function getExpenses($flag = "%d")
    {

        $last20ExpenseAmounts = $this->select("Sum(amount) as amount, DATE_FORMAT(expense_date, '$flag') as flag")
            ->where('user_id', session('user')['id'])
            ->orderBy('flag')
            ->groupBy('flag')
            ->limit(20)
            ->findAll();

        $data = [];
        $labels = [];
        $cnt = 1;
        foreach ($last20ExpenseAmounts as $amount) {
            $data[] = $amount['amount'];
            $labels[] = $cnt++;
        }
        return ['data' => $data, 'labels' => $labels];
    }

    public function getExpensesForDay($day)
    {

        return $this->where('expense_date', $day)->where('user_id', session('user')['id'])->findAll();
    }

    public function getExpensesForMonth($year, $month)
    {

        return $this->where('YEAR(expense_date)', intval($year))
            ->where('MONTH(expense_date)', intval($month))->where('user_id', session('user')['id'])
            ->findAll();
    }

    public function getExpensesForYear($year)
    {

        return $this->where('YEAR(expense_date)', $year)->where('user_id', session('user')['id'])->findAll();
    }

    public function getTotalExpense()
    {
        $val = $this->select("SUM(`amount`) as total_amount")
            ->where('user_id', session('user')['id'])
            ->find();
        return $val[0]['total_amount'];
    }

    public function getYearsCount()
    {
        $val = $this->select("COUNT(DISTINCT YEAR(`expense_date`)) as year_count")->where('user_id', session('user')['id'])
            ->get()
            ->getRowArray();
        return $val['year_count'];

    }

    public function getMonthsCount()
    {
        $val = $this->select("COUNT(DISTINCT DATE_FORMAT(`expense_date`, '%Y-%m')) as month_count")->where('user_id', session('user')['id'])
            ->get()
            ->getRowArray();
        // var_dump($val);die();
        return $val ['month_count'];


    }

    public function getDaysCount()
    {
        $val = $this->select("COUNT(DISTINCT (`expense_date`)) as day_count")->where('user_id', session('user')['id'])
            ->get()
            ->getRowArray();
        return $val['day_count'];

    }

}
