<?php

    namespace App\Jobs;

    use App\Mail\InviteJoinDocument;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldBeUnique;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;

    class SendEmail implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $maiAddress;
        protected $data;

        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct($maiAddress, $data)
        {
            $this->maiAddress = $maiAddress;
            $this->data = $data;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            try {
                $email = new InviteJoinDocument($this->data);
                Mail::to($this->maiAddress)->send($email);
            } catch (\Throwable $exception) {
                Log::error($exception);
            }
        }
    }
