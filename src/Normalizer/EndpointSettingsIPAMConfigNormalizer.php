<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EndpointSettingsIPAMConfigNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\EndpointSettingsIPAMConfig';
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Docker\API\Model\EndpointSettingsIPAMConfig;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            return null;
        }
        $object = new \Docker\API\Model\EndpointSettingsIPAMConfig();
        if (property_exists($data, 'IPv4Address') && $data->{'IPv4Address'} !== null) {
            $object->setIPv4Address($data->{'IPv4Address'});
        }
        if (property_exists($data, 'IPv6Address') && $data->{'IPv6Address'} !== null) {
            $object->setIPv6Address($data->{'IPv6Address'});
        }
        if (property_exists($data, 'LinkLocalIPs') && $data->{'LinkLocalIPs'} !== null) {
            $values = [];
            foreach ($data->{'LinkLocalIPs'} as $value) {
                $values[] = $value;
            }
            $object->setLinkLocalIPs($values);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getIPv4Address()) {
            $data->{'IPv4Address'} = $object->getIPv4Address();
        }
        if (null !== $object->getIPv6Address()) {
            $data->{'IPv6Address'} = $object->getIPv6Address();
        }
        if (null !== $object->getLinkLocalIPs()) {
            $values = [];
            foreach ($object->getLinkLocalIPs() as $value) {
                $values[] = $value;
            }
            $data->{'LinkLocalIPs'} = $values;
        }

        return $data;
    }
}
