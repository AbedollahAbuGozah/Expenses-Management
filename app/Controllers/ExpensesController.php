<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ExpensesController extends BaseController
{
    public function show_expenses_chart($period = "%d")
    {

        return redirect()->to('dashboard/' . $period);
    }

    public function delete($id)
    {

        $expenseModel = model('App\Models\Expense');
        $expenseModel->delete($id);
        return redirect('dashboard');

    }

    public function add_expenses()
    {


        $userData = $this->request->getPost(['description', 'amount', 'date']);
        $roles = [
            'description' => 'required',
            'amount' => 'required'
        ];


        if ($this->validate($roles)) {


            $expenseModel = model('App\Models\Expense');

            $expenseModel->save([
                'amount' => $userData['amount'],
                'description' => $userData['description'],
                'user_id' => session('user')['id'],
                'expense_date' => $userData['date']
            ]);
            // $this->session->setFlashdata('success_message', 'Your action was successful!');

            return redirect('dashboard')->with('successes', 'the expense added successfully');
        }
        return redirect()->back();


    }


}
