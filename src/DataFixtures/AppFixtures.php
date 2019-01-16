<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Customers;
use App\Entity\Orders;
use App\Entity\Items;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadCustomers($manager);
        $this->loadItems($manager);
        $this->loadOrders($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadOrders(ObjectManager $manager)
    {

        // echo $this->readable_random_string(rand(5,10)); die;
        //echo rand(1,1000); die;
        $limit = 500;
        for($i = 1;$i<=$limit;$i++){

            // echo $this->readable_random_string(rand(5,10)); die;
            //echo rand(1,1000); die;

            $delOptions= array("PickUp","Ship","delivered");
            $order = new Orders();
            $order->setNumber("MO-00".$i);
            $order->setContactemail($this->readable_random_string(rand(5,10))."@gmail.com");
            $order->setCustomerid("MA-00".$i);
            $order->setDeliveryoption($delOptions[rand(0,2)]);
            $order->setDiscountammount(rand(50,500));
            $order->setLoyaltypointsearned(rand(1000,5000));
            $order->setNetamount(rand(1500,4500));
            $order->setOrderdate(new \DateTime("now"));
            $order->setPhonenumber("+96".rand(8000000000,9900000000));
            $order->setStatus(rand(0,1));



            $manager->persist($order);
            $manager->flush();
        }

    }

    /**
     * @param ObjectManager $manager
     */
    public function loadItems(ObjectManager $manager)
    {

        // echo $this->readable_random_string(rand(5,10)); die;
        //echo rand(1,1000); die;
        $limit = 200;
        for($i = 1;$i<=$limit;$i++){

            // echo $this->readable_random_string(rand(5,10)); die;
            //echo rand(1,1000); die;

            $Items = new Items();
            $Items->setAvailableqty(rand(0,1));
            $Items->setCategory($this->readable_random_string(rand(6,8)));
            $Items->setDescription($this->readable_random_string(rand(25,40)));
            $Items->setDescriptionAr($this->readable_random_string(rand(25,40)));
            $Items->setDisplayname($this->readable_random_string(rand(7,11)));
            $Items->setDisplaynameAr($this->readable_random_string(rand(7,11)));
            $Items->setOnlineprice(rand(1000,5000));
            $Items->setSku("FGT0".rand(1,$i));

            $manager->persist($Items);
            $manager->flush();
        }

    }

    /**
     * @param ObjectManager $manager
     */
    public function loadCustomers(ObjectManager $manager)
    {

       // echo $this->readable_random_string(rand(5,10)); die;
        //echo rand(1,1000); die;
        $limit = 100;
        for($i = 1;$i<=$limit;$i++){

        $customer = new Customers();
        $customer->setCustId("MA-00".$i);
        $customer->setEmail($this->readable_random_string(rand(5,10))."@gmail.com");
        $customer->setFirstname($this->readable_random_string(rand(5,10)));
        $customer->setIsactive(rand(0,1));
        $customer->setLastorderdate( new \DateTime("now"));
        $customer->setLastsname($this->readable_random_string(rand(5,10)));
        $customer->setLastsnameAr('كمال');
        $customer->setFirstnameAr('عادل');
        $customer->setLoyaltypoints(rand(1001,5000));
        $customer->setPasswordhash(md5($this->readable_random_string(rand(9,14))));



        $manager->persist($customer);
        $manager->flush();
        }

    }

    /**
     * @param ObjectManager $manager
     */
    public function loadUsers(ObjectManager $manager)
    {

        $user = new User();
         $user->setUsername('admin');
         $user->setEmail('admin@demo.org');

         $role = new Role();
         $role->setName('Admin');
         $role->setDescription('Have access to control across the modules and components');
         $manager->persist($role);

         $user->setRole($role);
         $password = $this->encoder->encodePassword($user, 'pass_1234');
         $user->setPassword($password);

         $this->addReference('user_admin', $user);

         $manager->persist($user);

         $manager->flush();

    }

    public function loadBrands(ObjectManager $manager)
    {
        /*  $brand = new Brand();
          $brand->setDomain('www.aviationjobsearch.com');
          $brand->setSubdomain('course.aviationjobsearch.com');
          $brand->setEmailNewClient('info@aviationjobsearch.com');
          $brand->setEmailFrom('info@aviationjobsearch.com');
          $brand->setBrandName('Aviation Courses');
          $brand->setSeoName('aviation-courses');
          $brand->setContactPhone('9874563210');
          $brand->setContactPhone1('9874563212');
          $brand->setContactEmail('info@aviationjobsearch.com');
          $brand->setCategoryLimit('11');
          $brand->setActiveDays('365');
          $brand->setTimeZone('UTC+1h');

          $this->addReference('default_brand',$brand);

          $manager->persist($brand);

          $manager->flush(); */
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function readable_random_string($length = 6)
    {
        $string     = '';
        $vowels     = array("a","e","i","o","u");
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );
        // Seed it
        srand((double) microtime() * 1000000);
        $max = $length/2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }
        return $string;
    }
}
