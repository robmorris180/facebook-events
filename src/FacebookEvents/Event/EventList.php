<?php
    namespace Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Event;

    use Database;
    use Concrete\Core\Search\Pagination\Pagination;
    use Concrete\Core\Search\ItemList\Database\ItemList as DatabaseItemList;
    use Pagerfanta\Adapter\DoctrineDbalAdapter;
    use Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Event\Event as FacebookEvent;

    class EventList extends DatabaseItemList
    {

        public function createQuery()
        {
            $this->query
            ->select('e.id')
            ->from('RwmFacebookEvents', 'e')
            ->orderBy('e.event_time', 'DESC');
        }

        public function getResult($queryRow)
        {
            return FacebookEvent::getByID($queryRow['id']);
        }

        protected function createPaginationObject()
        {
            $adapter = new DoctrineDbalAdapter($this->deliverQueryObject(), function ($query) {
                $query->select('count(distinct e.id)')->setMaxResults(1);
            });

            $pagination = new Pagination($this, $adapter);
            return $pagination;
        }
        
        public function getTotalResults()
        {
            $query = $this->deliverQueryObject();
            return $query->select('count(distinct e.id)')->setMaxResults(1)->execute()->fetchColumn();
        }

    }