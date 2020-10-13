<?php

namespace App\Mail;

use App\WorkflowExec;
use App\WorkflowStep;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkflowActionNext extends Mailable
{
    use Queueable, SerializesModels;

    public $exec;
    public $step;
    public $execstep_url;

    /**
     * Create a new message instance.
     *
     * @param WorkflowExec $exec
     */
    public function __construct(WorkflowExec $exec)
    {
        $this->exec = $exec;

        $this->step = $exec->currentstep;
        if (! $this->step) {
            $this->step = WorkflowStep::where('id', $exec->current_step_id)->first();
        }

        $this->execstep_url = route('workflowexecs.show', $exec->uuid);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouvelle Action Bordereau Remise')
            ->markdown('emails.workflowactions.next');
    }
}
