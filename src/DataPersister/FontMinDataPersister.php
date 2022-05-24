<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\FontMin;
use App\Repository\FontMinRepository;

class FontMinDataPersister implements ContextAwareDataPersisterInterface
{
    private ContextAwareDataPersisterInterface $decorated;
    private FontMinRepository $fontMinRepository;

    public function __construct(ContextAwareDataPersisterInterface $decorated, FontMinRepository $fontMinRepository)
    {
        $this->decorated = $decorated;
        $this->fontMinRepository = $fontMinRepository;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        if ($data instanceof FontMin) {
            $fontMin = $this->fontMinRepository->findOneBy([
                'text' => $data->getText(), 'textHash' => $data->getTextHash(),
                'fontFamily' => $data->getFontFamily(), 'newFontFamily' => $data->getNewFontFamily()]);

            if ($fontMin) {
                return $fontMin;
            }
        }
        return $this->decorated->persist($data, $context);
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }

}