<?php

/*
 * This file is part of the td-avatar package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DoctrineListener;


use AppBundle\Entity\Image;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ImageUploadListener
{
    private $projectDir;

    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function postPersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();
        if ($entity instanceof Image) {
            $file = $entity->getFile();

            $fileName = $entity->getName().'.'.$entity->getExtension();

            $file->move(
                $this->projectDir.'/web/upload',
                $fileName
            );
        }
    }
}