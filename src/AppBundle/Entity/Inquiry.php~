<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPMentors\DomainKata\Entity\EntityInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Inquiry
 *
 * @ORM\Table(name="inquiry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InquiryRepository")
 */
class Inquiry implements EntityInterface
{

    /**
     *
     * @var int @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string @Assert\NotBlank()
     *      @Assert\Length(min = 2,max = 255)
     *      @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @var string @Assert\NotNull()
     *      @Assert\Email()
     *      @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     *
     * @var string @Assert\NotNull()
     *      @Assert\Regex(pattern="/^[0-9\-]*$/", message="半角数字とハイフンのみです。")
     *      @ORM\Column(name="tel", type="string", length=20)
     */
    private $tel;

    /**
     *
     * @var string @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     *
     * @var string @Assert\Length(min = 2,max = 5000)
     *      @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     *
     * @var string @Assert\NotBlank(groups={"admin"})
     *      @ORM\Column(name="process_status", type="string", length=20)
     */
    private $processStatus;

    /**
     *
     * @var string @Assert\NotBlank(groups={"admin"})
     *      @ORM\Column(name="process_memo", type="text")
     */
    private $processMemo;

    public function __construct()
    {
        $this->processStatus = 0;
        $this->processMemo = '';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Inquiry
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Inquiry
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Inquiry
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
        
        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Inquiry
     */
    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Inquiry
     */
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set processStatus
     *
     * @param string $processStatus
     *
     * @return Inquiry
     */
    public function setProcessStatus($processStatus)
    {
        $this->processStatus = $processStatus;
        
        return $this;
    }

    /**
     * Get processStatus
     *
     * @return string
     */
    public function getProcessStatus()
    {
        return $this->processStatus;
    }

    /**
     * Set processMemo
     *
     * @param string $processMemo
     *
     * @return Inquiry
     */
    public function setProcessMemo($processMemo)
    {
        $this->processMemo = $processMemo;
        
        return $this;
    }

    /**
     * Get processMemo
     *
     * @return string
     */
    public function getProcessMemo()
    {
        return $this->processMemo;
    }
}
