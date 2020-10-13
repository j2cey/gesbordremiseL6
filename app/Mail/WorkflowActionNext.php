<?php

namespace App\Mail;

use App\WorkflowAction;
use App\WorkflowExecAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkflowActionNext extends Mailable
{
    use Queueable, SerializesModels;

    public $actionexec;
    public $action;
    public $action_url;

    /**
     * Create a new message instance.
     *
     * @param WorkflowExecAction $actionexec
     */
    public function __construct(WorkflowExecAction $actionexec)
    {
        $this->actionexec = $actionexec;

        $action = $actionexec->action;
        if (! $actionexec) {
            $action = WorkflowAction::where('id', $actionexec->workflow_action_id)->first();
        }
        $this->action = $action;

        $this->action_url = route('workflowexecactions.show', $actionexec->uuid);
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
