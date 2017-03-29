<?php
namespace Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Event;

use Package;
use Database;
use Page;
use Core;
use Concrete\Core\Foundation\Object as Object;

/**
 * @Entity
 * @Table(name="RwmFacebookEvents")
 */
class Event
{

    /**
     * @Id @Column(type="bigint")
     */
    protected $id;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $event_title;

    /**
     * @Column(type="datetime")
     */
    protected $event_time;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $event_cover;


    public function getId()
    {
        $this->id = $id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEventTitle()
    {
        return $this->event_title;
    }

    public function setEventTitle($title)
    {
        $this->event_title = trim($title);
    }

    public function getEventTime()
    {
        return $this->event_time;
    }

    public function setEventTime($time)
    {
        $this->event_time = new \DateTime($time);
    }

    public function getEventCover()
    {
        return $this->event_cover;
    }

    public function setEventCover($cover)
    {
        $this->event_cover = trim($cover);
    }

    public static function getByID($id) {
        $db = Database::connection();
        $em = $db->getEntityManager();
        return $em->find('Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Event\Event', $id);
    }

    public static function saveEvent($args)
    {

        $event = new self();
        $event->setId($args['id']);
        $event->setEventTitle($args['title']);
        $event->setEventTime($args['time']);
        $event->setEventCover($args['cover']);
        
        $event->save();

        return $event; 

    }

    public function save()
    {
        $em = Database::connection()->getEntityManager();
        $em->persist($this);
        $em->flush();
    }

}