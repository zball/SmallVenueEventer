<?php


namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Venue", mappedBy="user")
     */
    protected $venues;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\BillingAddress", mappedBy="user")
     **/
    private $billingAddress;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RedeemableTicket", mappedBy="user")
     **/
    private $redeemableTickets;

    public function __construct()
    {
        parent::__construct();
        $this->venues = new ArrayCollection();
        $this->redeemableTickets = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getVenues()
    {
        return $this->venues;
    }

    /**
     * @param $venues
     */
    public function setVenues($venues)
    {
        $this->venues = $venues;
    }


    /**
     * Add venues
     *
     * @param \AppBundle\Entity\Venue $venues
     * @return User
     */
    public function addVenue(\AppBundle\Entity\Venue $venues)
    {
        $this->venues[] = $venues;

        return $this;
    }

    /**
     * Remove venues
     *
     * @param \AppBundle\Entity\Venue $venues
     */
    public function removeVenue(\AppBundle\Entity\Venue $venues)
    {
        $this->venues->removeElement($venues);
    }

    /**
     * Set billingAddress
     *
     * @param \AppBundle\Entity\BillingAddress $billingAddress
     * @return User
     */
    public function setBillingAddress(\AppBundle\Entity\BillingAddress $billingAddress = null)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return \AppBundle\Entity\BillingAddress 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Add redeemableTickets
     *
     * @param \AppBundle\Entity\RedeemableTicket $redeemableTickets
     * @return User
     */
    public function addRedeemableTicket(\AppBundle\Entity\RedeemableTicket $redeemableTickets)
    {
        $this->redeemableTickets[] = $redeemableTickets;

        return $this;
    }

    /**
     * Remove redeemableTickets
     *
     * @param \AppBundle\Entity\RedeemableTicket $redeemableTickets
     */
    public function removeRedeemableTicket(\AppBundle\Entity\RedeemableTicket $redeemableTickets)
    {
        $this->redeemableTickets->removeElement($redeemableTickets);
    }

    /**
     * Get redeemableTickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedeemableTickets()
    {
        return $this->redeemableTickets;
    }
}
