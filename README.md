MagicWand-PHP (Yeah, this code sucks, you should not use it)
=============

MagicWand Tool for PHP

**Requires GD Library**

**USAGE:**
call the magicWand function with the following parameters:

```
magicWand(
  @param int x, the x coordinate of starting pixel
  @param int y, the y coordinate of starting pixel
  @param int tollerance, tollerant percentage. 0 = only exact same color, 1 = all colors
  @param resource imageHandle, the handle from any GD creating instance lik imagecreatefrompng
  @return bool, return true at the end of the function
)
```
