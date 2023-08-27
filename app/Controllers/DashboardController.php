<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Expense;
use Exception;
use function PHPUnit\Framework\equalToIgnoringCase;

class DashboardController extends BaseController
{
    public function index($flag ="%d/%m/%y")
    {

        if(session('user')==Null)
        {
            return redirect('login');

        }
        $userData = $this->request->getPost(['filter']) ;

        if($flag == "%d")
        {
            $flag = "%d/%m/%y";
        }
        else if($flag == "%m")
            $flag ="%m/%y" ;



        $expenseModel = model('App\Models\Expense') ;
        $ret = $expenseModel->getExpenses($flag) ;
        $data = $ret['data'];
        $labels = $ret['labels'] ;
        /*var_dump($labels);
        die();*/

        $ExpenseModel = model('App\Models\Expense') ;
        $expenses = $ExpenseModel->where('user_id' , session('user')['id'])->findAll() ;


        if($userData['filter'] != null) {
            $date = explode('-',$userData['filter']) ;
              if(count($date) == 1)
              {
                  $expenses = $ExpenseModel->getExpensesForYear($date[0]);
              }
              else if(count($date) == 2)$expenses = $ExpenseModel->getExpensesForMonth($date[0] , $date[1]);
              else $expenses = $ExpenseModel->getExpensesForDay($userData['filter']);

        }

       /* $totalExpenses = $expenseModel->select("SUM(`amount`) as total_amount")
            ->where('user_id', session('user')['id'])
            ->find();*/

        $totalExpenses = $expenseModel->getTotalExpense() ;

        $numberOfDistinctYears = max(1,$expenseModel->getYearsCount()) ;
        $numberOfDistinctMonths = max(1,$expenseModel->getMonthsCount());
        $numberOfDistinctDays = max(1,$expenseModel->getDaysCount());

            $avaregeExpenseDay = $totalExpenses/$numberOfDistinctDays ;
            $avaregeExpenseMonth = $totalExpenses/$numberOfDistinctMonths ;
            $avaregeExpenseYear = $totalExpenses/$numberOfDistinctYears ;

        //var_dump($flag);die();

      //var_dump([$avaregeExpenseYear,$avaregeExpenseDay,$avaregeExpenseMonth]);die();


        return view('dashboard' , [

            'currentRoute' => 'dash',
            'data'=>$data,
            'labels' => $labels,
            'expenses' =>$expenses,
            'avaregeExpenseDay'=> [0=>$avaregeExpenseDay , 1=>$totalExpenses-$avaregeExpenseDay],
            'avaregeExpenseMonth'=> [0=>$avaregeExpenseMonth,1=>$totalExpenses-$avaregeExpenseMonth] ,
            'avaregeExpenseYear' => [0=>$avaregeExpenseYear,1=>$totalExpenses-$avaregeExpenseYear]

        ]) ;


    }


}
