<?php

namespace App\MessageHandler;

use App\Message\FontMinMessage;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Process\Process;

final class FontMinMessageHandler implements MessageHandlerInterface
{
    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(FontMinMessage $message)
    {
        $projectDir = $this->parameterBag->get('kernel.project_dir');

        $fontFamilyPath = $projectDir . '/assets/fonts/' . $message->getFontFamily(). '.ttf';
        $newFontFamilyPath = $projectDir . '/public/assets/fontmin/' . $message->getNewFontFamily() . '.ttf';

        $textOption = '--text=' . $message->getText();
        $outputFileOption = '--output-file=' . $newFontFamilyPath;

        $process = new Process(['pyftsubset', $fontFamilyPath, $textOption, $outputFileOption]);

        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > ' . $buffer;
            } else {
                echo 'OUT > ' . $buffer;
            }
        });
    }
}
