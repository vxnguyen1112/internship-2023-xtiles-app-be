<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Tracker;
    use App\Repositories\DocumentRepository;
    use App\Repositories\NotificationReponsitory;
    use App\Repositories\ShareDocumentRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class NotificationReponsitoryEloquent extends BaseRepository implements NotificationReponsitory
    {

        public function model()
        {
            return Tracker::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

        public function getNotification()
        {
            $account_id = auth()->user()['id'];
            Tracker::where(["account_id" => $account_id, "is_read" => false])->update(['is_read' => true]);
            return Tracker::where("account_id", $account_id)->latest()->get();
        }

        public function checkNotification()
        {
            $account_id = auth()->user()['id'];
            return Tracker::where(["account_id" => $account_id, "is_read" => false])->exists();
        }
    }
