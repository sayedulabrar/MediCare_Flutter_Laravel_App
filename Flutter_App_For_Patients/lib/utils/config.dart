import 'package:flutter/material.dart';

class Config {
  static MediaQueryData? mediaQueryData;
  static double? screenWidth;
  static double? screenHeight;

  // width and height initialization
  static void init(BuildContext context) {
    mediaQueryData = MediaQuery.of(context);
    screenWidth = mediaQueryData!.size.width;
    screenHeight = mediaQueryData!.size.height;
  }

  static double? get widthSize {
    return screenWidth;
  }

  static double? get heightSize {
    return screenHeight;
  }

  // Define spacing height using getters
  static const spaceSmall = SizedBox(
    height: 25,
  );

  static SizedBox get spaceMedium {
    return SizedBox(
      height: screenHeight != null ? screenHeight! * 0.05 : 0.0,
    );
  }

  static SizedBox get spaceBig {
    return SizedBox(
      height: screenHeight != null ? screenHeight! * 0.08 : 0.0,
    );
  }

  // TextForm field border
  static const outlinedBorder = OutlineInputBorder(
    borderRadius: BorderRadius.all(Radius.circular(8)),
  );

  static const focusBorder = OutlineInputBorder(
      borderRadius: BorderRadius.all(Radius.circular(8)),
      borderSide: BorderSide(
        color: Colors.greenAccent,
      ));
  
  static const errorBorder = OutlineInputBorder(
      borderRadius: BorderRadius.all(Radius.circular(8)),
      borderSide: BorderSide(
        color: Colors.red,
      ));

  static const primaryColor = Colors.greenAccent;
  static const primaryColor2 = Colors.black;
}
