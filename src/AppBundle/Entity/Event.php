<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @var boolean
     * @ORM\Column(name="allAges", type="boolean")
     * @Assert\Type(type="bool", message="Type must be boolean.")
     **/
    private $allAges;


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
     * Set allAges
     *
     * @param boolean $allAges
     * @return Event
     */
    public function setAllAges($allAges)
    {
        $this->allAges = $allAges;

        return $this;
    }

    /**
     * Get allAges
     *
     * @return boolean 
     */
    public function isAllAges()
    {
        return $this->allAges;
    }
}
