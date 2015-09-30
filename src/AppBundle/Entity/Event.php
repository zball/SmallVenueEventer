<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\EntityListeners({ "AppBundle\Listener\EventListener" })
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Venue", inversedBy="events")
     **/
    private $venue;

    /**
     * @var DateTime
     * @ORM\Column(name="eventStart", type="datetime")
     *
     * @Assert\GreaterThanOrEqual("now")
     **/
    private $eventStart;

    /**
     * @var DateTime
     * @ORM\Column(name="eventEnd", type="datetime")
     **/
    private $eventEnd;

    /**
     * @var string
     * @ORM\Column(name="minAge", type="string", length=10)
     **/
    private $minAge;

    /**
     * @var int
     *
     * @ORM\Column(name="maxCapacity", type="smallint")
     * @Assert\GreaterThan(value="0")
     */
    private $maxCapacity;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="event", cascade={"persist"})
     **/
    private $tickets;



    /**
     * @Assert\Callback
     */
    public function validateEventEnd(ExecutionContextInterface $context){
        if($this->eventEnd < $this->eventStart){
            $context->buildViolation('Ending Date must be after Starting Date.')
                ->atPath('eventEnd')
                ->addViolation();
        }
    }

    public function __construct() {
        $this->tickets = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set venue
     *
     * @param \AppBundle\Entity\Venue $venue
     * @return Event
     */
    public function setVenue(\AppBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return \AppBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }

    



    /**
     * Set eventStart
     *
     * @param \DateTime $eventStart
     * @return Event
     */
    public function setEventStart($eventStart)
    {
        $this->eventStart = $eventStart;

        return $this;
    }

    /**
     * Get eventStart
     *
     * @return \DateTime 
     */
    public function getEventStart()
    {
        return $this->eventStart;
    }

    /**
     * Set eventEnd
     *
     * @param \DateTime $eventEnd
     * @return Event
     */
    public function setEventEnd($eventEnd)
    {
        $this->eventEnd = $eventEnd;

        return $this;
    }

    /**
     * Get eventEnd
     *
     * @return \DateTime 
     */
    public function getEventEnd()
    {
        return $this->eventEnd;
    }



    /**
     * Set minAge
     *
     * @param string $minAge
     * @return Event
     */
    public function setMinAge($minAge)
    {
        $this->minAge = $minAge;

        return $this;
    }

    /**
     * Get minAge
     *
     * @return string 
     */
    public function getMinAge()
    {
        return $this->minAge;
    }

    /**
     * Set maxCapacity
     *
     * @param integer $maxCapacity
     * @return Event
     */
    public function setMaxCapacity($maxCapacity)
    {
        $this->maxCapacity = $maxCapacity;

        return $this;
    }

    /**
     * Get maxCapacity
     *
     * @return integer 
     */
    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }

    /**
     * @return mixed
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param mixed $tickets
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

}
