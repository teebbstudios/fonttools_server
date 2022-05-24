<?php

namespace App\Serializer\Normalizer;

use App\Entity\FontMin;
use App\Repository\FontMinRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class FontMinNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    private $request;

    public function __construct(ObjectNormalizer $normalizer, RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();

        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        if ($object instanceof FontMin) {
            $schemaAndHost = $this->request->getSchemeAndHttpHost();
            $data['url'] = $schemaAndHost . '/assets/fontmin/' . $object->getNewFontFamily() . ".ttf";
        }

        return $data;
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof FontMin;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

}
