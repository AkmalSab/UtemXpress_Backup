<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HeaderComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $message, $active, $ongoing, $complete;

    public function __construct()
    {
        $id = Auth::id();

        $roles = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->where('users.id', '=', $id)
            ->select('user_roles.role_id')
            ->get();

        foreach ($roles as $item){
            $this->message = $item->role_id;
        }

        $vehicle = DB::table('order')
            ->where('order_status', '=', 'waiting')
            ->where('id', '=', $id)
            ->count('order_id');

        $runnerID = DB::table('runner')->where('user_id', $id)->first();

        if(isset($runnerID)){
            $onGoingOrders = DB::table('order')
                ->where('runner_id', '=', $runnerID->runner_id)
                ->where('order_status', '=', 'on-going')
                ->get();

            $completeOrders = DB::table('order')
                ->where('runner_id', '=', $runnerID->runner_id)
                ->where('order_status', '=', 'completed')
                ->get();

            $this->ongoing = $onGoingOrders;
            $this->complete = $completeOrders;

            //dump($this->ongoing);
        }
        //assign to variable
        $this->active = $vehicle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-component');
    }
}
