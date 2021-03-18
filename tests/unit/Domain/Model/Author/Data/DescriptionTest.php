<?php

namespace App\Tests\unit\Domain\Model\Author\Data;

use App\Domain\Model\Author\Data\InvalidAuthorDataException;
use App\Domain\Model\Author\Data\Description;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    /** @test */
    public function should_not_allow_more_than_3500_characters(): void
    {
        $this->expectException(InvalidAuthorDataException::class);
        $this->expectExceptionMessage('Description should be less than 3500 characters');
        new Description('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing at in tellus integer feugiat. Ornare arcu odio ut sem nulla pharetra diam sit amet. Dapibus ultrices in iaculis nunc. Massa massa ultricies mi quis hendrerit. Fermentum iaculis eu non diam phasellus vestibulum. Rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Ultrices in iaculis nunc sed augue. Ipsum suspendisse ultrices gravida dictum fusce ut placerat orci. Condimentum mattis pellentesque id nibh tortor. Commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit. Iaculis eu non diam phasellus vestibulum lorem sed. Pretium quam vulputate dignissim suspendisse in est ante in nibh. Ultricies tristique nulla aliquet enim tortor at auctor. Tellus rutrum tellus pellentesque eu tincidunt.

Leo integer malesuada nunc vel risus commodo viverra. Eu non diam phasellus vestibulum lorem. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Nisl tincidunt eget nullam non nisi. Maecenas pharetra convallis posuere morbi leo urna molestie. In hac habitasse platea dictumst. Eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim. Ut ornare lectus sit amet. Blandit libero volutpat sed cras ornare arcu. A cras semper auctor neque vitae tempus quam pellentesque. Habitant morbi tristique senectus et netus et malesuada fames ac. Nam aliquam sem et tortor consequat id. Amet cursus sit amet dictum sit amet justo donec. Eleifend donec pretium vulputate sapien nec sagittis aliquam. Elementum nisi quis eleifend quam adipiscing vitae proin sagittis. In nulla posuere sollicitudin aliquam ultrices. Commodo viverra maecenas accumsan lacus vel facilisis volutpat.

Viverra mauris in aliquam sem fringilla ut morbi tincidunt. Est placerat in egestas erat imperdiet. Id diam maecenas ultricies mi. Cursus vitae congue mauris rhoncus aenean vel. Tellus mauris a diam maecenas sed enim ut sem. At augue eget arcu dictum varius duis. Scelerisque varius morbi enim nunc faucibus. Suspendisse in est ante in nibh. Maecenas ultricies mi eget mauris pharetra et. At urna condimentum mattis pellentesque. Ut ornare lectus sit amet est placerat in egestas.

Malesuada proin libero nunc consequat interdum varius sit amet mattis. Integer quis auctor elit sed vulputate mi sit. Mauris in aliquam sem fringilla. Quam adipiscing vitae proin sagittis nisl. Eu mi bibendum neque egestas congue quisque egestas diam. Viverra nibh cras pulvinar mattis. Elit at imperdiet dui accumsan sit amet nulla facilisi. Sed enim ut sem viverra aliquet eget sit amet. Nisl nunc mi ipsum faucibus vitae aliquet. Ornare arcu dui vivamus arcu felis bibendum ut tristique. Lacus luctus accumsan tortor posuere ac ut consequat semper viverra. Sem fringilla ut morbi tincidunt augue.

Sit amet luctus venenatis lectus magna fringilla urna porttitor. Diam ut venenatis tellus in metus vulputate eu scelerisque felis. Malesuada proin libero nunc consequat interdum varius sit. Sapien nec sagittis aliquam malesuada bibendum arcu vitae elementum. Ornare massa eget egestas purus viverra accumsan. Id eu nisl nunc mi. Diam maecenas ultricies mi eget mauris. Id semper risus in hendrerit gravida rutrum quisque. Ut sem viverra aliquet eget sit amet tellus cras. Dictum non consectetur a erat nam at lectus. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Id faucibus nisl tincidunt eget nullam non. Sed vulputate mi sit amet mauris commodo quioss.');
    }
}
