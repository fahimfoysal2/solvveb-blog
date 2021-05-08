@extends('layouts._adminLayout')
@section('title', 'Register')

@section('sidebar')
    {{--  not to use sidebar from master layout  --}}
@endsection

@section('top-bar')
@endsection

@section('main-content')
    <body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-2 my-md-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <a href="/">
                                            <svg width="180" height="90" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
                                                <g id="Layer_1">
                                                    <title>Solvveb: Technology Blog</title>
                                                    <image
                                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOwAAABiCAYAAABTaT+8AAAgAElEQVR4Xu1de1xVVfb/XkAlchxFfIddjYhBU4M0Kaxrmkw4ojExkqVY+cCfLxyVMgeBHKMRzVf+fKemkYY/QgwMFSXFwUeQ+BqGyBBKFBHJfKAC5/fZ53Hveexz74V43Jvn/DFj3P1Ye+313XvttddaWwft0zigccBuOKCzG0o1QjUOaByABlhNCDQO2BEHNMDa0WRppGoc0ACryYDGATvigAZYO5osjVSNAxpgNRnQOGBHHNAAa0eTpZGqcUADrCYDGgfsiAMaYO1osjRSNQ5ogNVkQOOAHXFAA6wdTZZGqsYBDbCaDGgcsCMOaIC1o8nSSNU4oAFWkwGNA3bEAQ2wdjRZGqkaBzTAajKgccCOOKAB1o4mSyNV44AGWE0GNA7YEQfsEbCEZsaOeKyRqnGgwThgN4AdMmRI+z179hQ85OLieu7s2d3Tpk0bn5mZeQNAbYNxQ2tI44CNc8AuAGswGFpnpmVehAtcydaqY/+H22YJeGfOnPl2RkbGNRvntUZe3Tng6O3t7Siu1rFjx9qysjIH8rfz58/fq3uT9l3DHgDreAVXTndCJ28OogLJItTqGKSmpsUsWLDgg5ycnPv2PSUa9QIHSlDyrTse8TXOOcOdhITzUElJyfGIiIhXy8rKbt25c+duTk5O1e9d47J9wB45shqDBv2PmhiLIXzrFspnzw4fvHbt2rOa2Ns5B8aO7YFt2y6IRyFZrhlAJ5Fe7tfKysqf09LS/pWSkpJ88eLF8uzs7Dt2zgkJ+TYN2Dlz5jyzZMmSY5KNlV9hzRKenPwPjBr1gWacajJRJSoqmRJiT9D5+vo65uTkkH/LjYPiaVMzHOr0en2LoqNF/0ZXPMXoTDqV6mjESJbJx61bt8qXLFnyt0OHDh3JzMysbjKONFJHNgtYX1/fFjk5OWUA01aiBhtnkAHE/5ZlbC0oQEZYmN8IG15hCe+JoNc00tw2erPPPPNMm82bNyd4/+lPw1n2U+dD7RgjJ49Xd/niOpWjjxp8GTBQ1DEq0JyYV1VVVW7evHnazp07UzMzMysbnUGN0IHNAjYpCe8GByPO7Jilx1jaXN6eMmWK35o1a043Au/q3WRkZOTAxYtjUgEXoq49Uu+Gmr1i4UHAYzBVbZXteuZ2R6t2UUondehCmYC7rCx//ooVbx89evSEPe28NglYsnIfP378F9kCaZwyixMlKxAZCb/Fi3Gs2eUbwI4dOyJCQ0OXCcaTp319W9qtoawCF+CKHnWdD2tVW6Fcfdq3tg4ptycF0StXDl1x4MABTuZs+LNJwAJHVgNSQxN3nSO2NFicEo7t/Elp0uRJf1q/fn1+c87Fxo0bw96eMGGLcC1FaJk6dWrv1atXn2tOuurd901cQWt0VNY3zY1UVbXGAMFNmknBFR99zFMq7tWKk69pP+DvCgsKdBkxMWMmJSQkSIxd9eZPI1S0OcASB4mMjIxyy2NlgErdz6jAD9U9MdAJaGmhzm29Xt++qKiImP6b/Hvrrbee+OSTTflyQcrLy0vq27fvX1UI0hkMBseGVNm8vb1bNuD9JdmR2sg1ISuXUsktnbSOmRasalxZSLzWm22C/PjjhcMew4YNKywsvNvkgmKhQ5sDbFYW1vr7Y7JcCOTjyM/PT/Py8hpBLJMGg6FtZmbmdUt1UlNTY4cPHx7T1JPAG9B+ApS7ETGOeXpiqJymzZs3vzV+/JubyNVFUFBQ55SUlCtW0u3o6+vb6tq1a7WyxUm3ZcuWt8aPH78RWVgHf4Rb2R4MBoPT3bt3W1y9erVWJsRGS68EBBQ7k9CXmZ+sIYdYeZ0kBeuDbevqJAFQW0itobVRytgUYAMCAlzT09PpHktSzajAYDD0Eu88qUiNHg4KGJWT0wJA05r30/EBAjBPWFDERpY9e/ZEjRgx4p+i2dVlZWX9r7+/f7hA+po1a16bMmXKDksSoNfrnX8sKrrDbl2MDqdP5+2KioqaSSzRKRs3ZqJjRy+hDV8rz85Tp07ttXr1avZem2EY7N69+x+jRo360GAw6A4dyrwvvQulU2icAqt2R64NoSjpMzAwsOPevXuvAnBEZeVFtG3bjdqTUUbq1pGa0cvb27tVA2ojlqbPqt9tCrDIwhr5yk9VlQIDuyAt7bJ4hCEhId0TExMvmh01wyBi1izf5cuX51rFnYYpRHhczQAOOsqF8tp1a8eGh4dvF7pKR/oHAQjgwC2I7pEs4jwyzRI5+fn56V5eXsMUHmFEIsknOjzv379/yUsvvTTXUptXcOUc52XGwUg4WxIgcWDlfURlTgySMyjtkUQKpqhn0NTUGAwfHivQuXTp0qDZs2fvFnGHb122d+f/Ny3v7t3bfft6/wVMC2fL7zQqrwmTk5PJ4rTIEo+a8nebAay/v3+7rKysCuPqqrJIXgAO9wReoDCJ+Jxa3DljY2NfjI6OPtRUTH755Zc77N27t0ytvxUrEDxzJr4kv0dF4YWFC5FJKUuupfpapLkchXDDYxbLEd7+UPgNPDwMFsqaeGrFpsXbbqy19wjLEYcllfYDAwO7pIkWZ4mNQ50mohE8yY9NN2nSpCfCw9cv8PHBa2r9iPkgjOPGryht0wZdLfKzCQvYDGBTgAVBgHElVfCAn5whQ4a4mXH0J0YCk/GJryOe14mY+MQGbChoKh5LdgQRIcI/t2DLhPEYv4mnh5zD26rQRsBjLjJJ8DTiZNIywL4D4GOOD5yh7BOlZZ0/uTJ8J3UVIsukcVTVArUO3JnVeFZWdTaRzvU3ABSLEdkU3nvvvVmBgYFR4tVCaFxlHHUdXqOKlq0QQ4SRWG+dlEut2MRfkAF4Kgw0AoeuA0XtgEelC7Z4Jhn06dO39enTp29Zy9XnnnvuDy1atGCcnJwcq6urazIzM0ldsQCZberIkSOrB/G+0ApvHKKqfpO5EgYDOWeKACdWKLl/z549e8DSpUtPqnU2ZsyYRxMSEoq432XqIdUD6X4V0OIhs8QXFByA5+NDFAEX/HmWEx7Bd1DWJ7gDAHeeNvUiEThBpRbRzLXC/e+ZM2eSn3zyyVcoNPILm7i0qP/8/DR4eQ1XGxuxlM+YMeOv48PHr3WGM2/lVr0ytBWMCNy2VnQbs1zkAGDxcWMPqldvE5+Amd2xrAz/6dgRRsMKhWISjtXKmpEEBwc/smTJks969OjxvFhgf/nll58///zzOXv37j2UkpJCVF2z4C0sLDzo4SH1BhL3f/kyznbuzKlvVVX4xdmZvyZREpkD4Gk12hMTE+eEhITEWxqb+HrD19f34ZycnNtqdUpKcMLdHf1paiS3+PCAFTWg3D0ZJCbuIrQtMxgMLtXV1S3u379f4+DgcP+XX36p8fLy6jhu3LgwX1/fkR06dHjcwcGhZW1t7T3ngwdXITDwfZVjzrcMA18zBq89AIIs8YK/4lJe3UjlTwMshZGfARijymBOCgjYnM0C5DLOoDN6KzYZ455T+A1g9tym++ijj4JC/h4y3x3u/c3SQ368h5uRUZEvLV68WNWL6tSpU1/069cvhC70XA86zqeYOQZsGgi8JemXRwCvHkpiQyXlyssL4eZmPL9ao3bGx8cHzZ07lwi32keMc0/R6KmqqrrRqlWrNjqdwpQmbYth4D9okGtWVhZ37dYw31EAzxqbkg32LLC7NzDKyq6Ie6izGX5pgBUzsk+fPg+fPp13U6p2iVdujpX5yE/zgrqaw7X5cy7QlRcwQZDEy2XuTsAnlDaRkydP9l60aFGym1v7xznAq6t67M+CvbQWtR6eHi5ql+z5yE/1glcg16dIKRa2OoaBYfDgFuSKavHixYGRkZGpcpWWVYq58maEp7aGgYMDZ8ARqXeq3mEMSksvn+7SpYs5Y9Y1gHGVq8TVwD0nwOXMmTO7nuz95Cil1cgk/vyILZ2/rcSWsdgJgOEXVI4lRs6yXZ/bA/SyuMPy9+P3lId+I/1E+3i4rsQ1ZvlmXz3WA2MnAZ/SVnHxqncS2N4fGGuOGfn5SH/CC8PUBpWUlDQvODj4Q3kb2che7we/iaptSw0aimLbt2+f9sYbb6ym1S8pKfnW3d3dV61tHk/EsFIzbNiwjvvS910xcwXB7sQqbRF3uh6K35RHS/lmT2UXcZbIzMxUSwZAQhfnY/HivyAy0rRDU7YpHkjm6K67fF/BOXSCt/qumJ8Gi4s7sBIrg2dgxv+Z4Rmxq5g/59ed+t9Uo9kB+zOQ202udomHxM/KJeBUV3PlSJ0MLMEQzFYz3RsMhnaKsKr5eBaLQFQs6qcQCnUpYUEnb+Ty5ctnOnfu3FuNJh6wwg7kCAbV8sgyoU0/Pz8XlXBB1TA9YeehjoM0bIpJk5AeHo7ea9fiDI0p4eF4cu1anBXuvs1ZWbn7Wl3D7rBl+A8EWwV9Pr4G8LI5ZLBphzIziZOO8VZBZWqbHSPicTQ3Mbxl1JoTFxAcHOyelJREXPyoX2hoqH7Hjh0/SvDOCYxwiqUIzsltQP83KBsR2wwR+KwjWas/+OCD2BYtWrRYsmTJp56enkOMShhfMTg4uGtSUlKpkjCipnfj1XQePmwd3sIpFWjihcBf3QhTI5QD3n8/dmh0dHSGvI+JEyd6btiw4b88waa22QEI4+dGQ7kkVdn9UqPBeo4pOePh4eFMjgB+fn4PZWdnU4xWIpW4MQBbVHQUer3pDCvMFKPjnTny9wFeAWYAS+SAWNyfMp0Y1CTAssvFb9oy61jZRgArolrEN6V4lf9gMLzqZcEZ/i4DtFQMLDU1FnQ/YrKLcIYq+VdY+I3f2LEvi3c1CThE5ZcuXTpy9uzZKcomCg8+5uExWI3R8h2opKTkhLu7isGrkO7ssHPnzlmjR4/+iAZJ1uf6Ca9AudgJvA0NDe2xY8cO/jpIRH0RjkIvMuyY4E4WFMH4ZbyKUtcg2AWjQeUsOxvr/fzAHmHoS71ZwDrk5yPVywt/ps65qMErV3C+Uyf0qiOmGrV4gzKynpRmAxhoiXmi34m6Q+7Y6E4EJfgW7lCcGfV6/UMqkTpkx1b4phKrbG9v74fkvqRGQ4WM4Ozs7I1+fspzcG5uboLPUz6vqa3TMpUYa9asCZ0yZcrnNH5UoOJHV7j2pPy2DcAbtDpkN4wrLJweAsQbZVEs5aeQiH74m7zuPeBWS8BFAgjuP4g3WntReXIMcKCU44pwA2zQM+zatXgtPBwJZryW0ngZkQ/LCYU4AA+qpxy/Txt1kNrwcPQlqn895bpRqjU7YOfPn++/aNGiIxZHx6uRxGJ6TAUcbBuHD6/E889PF3Of4mAv7o5qxDEDDsmuIhiTb968Wda6detOinHs2/cvDBsWyUsva30WO5vzO6zx/DtixAi3PXv2XDUJI2flJnXu4HaFC1zEYGGbrULVL0YHABEBxcXFx7p37+7n4eHRqrCwkBpWSK5nnJ2d/yij2zRGGSpqamqqHR0dSQCF8FEWPLGa1PCADUbwI0lIKpHQzHfJ/V/hIcDjRdmYHIELB4Gez8vrKZ3/z+0xGKaOs8U0Ms0OWJZ5J09+iv79qRZgqsrDADGxMS/ExMQclgOE+O6m7d1bJgzs6tWrBR06dCBqjcLP2AgOvhFxX+Xl5d+7ubl50hYS/qJI+hNXWcHP7du3T33jjTc+5k+i0jMk6wTEqoxig5WOAVNLz09UdQMwBy4pSTExEh79CqC1fKW6cxsVLi6SHRNSLUI6A/Hx8X+ZO3duqqidM2DQWzpyeZBAw6rEcocHhYxcuHAYPXuK/c0Jfw9A5INOlata1EZFRxkWLlxoeQOxuMM0TgHbACzgUAIcc2fQ3xj8YdkOVT1ixIgue/bsUQS7E6+fV18Nif/++4L9w4YNC1ILWl+xYsUrM2fOJHGPiu8qUNABeEKF7TSfX7mqyFaNj48fMXfuXMXZVmiXaIyDBxvYe1jT3xhG5dgnPj/KsacgVRJCV4mf0BbdRPYurvw93EZL6V0je720b58x/lZch3K0IE4jz5CmFG2zf7R0f1xvwaZqRnxr5EjBOuL4+vq65KTkZKEbnjInUrm5uZ9Pnz598tGjR8nCZrOfrQCWY2xODgmPc1NwS90Q9bNer/egAZLfJcwnFT90aBkGD46gnYUKUXjIQ6lWCaRdBoNOsv2UZOEjtEuudiIiInyWL19O3AqpGRbIXvS079PivE46kiCbZngibOgli9GU7DZKiRTPr9JridBUhRtwhkQl/hAfBryDd79WCAflPFoG/KcjVNxBWUg1vErMTwK5knE1yopo7BUVFT+6urp6RCFq0D+w8KtWMs1CVufrkJCQyYmJicU2i1IRYTYDWEJTYGBg57S0NHI2kWQVMM0FNbUpAQNZ4euRLjQ/HSDxo8rv5MmT2/r37z9OZRJ/YsB0E9RW4WqAFrpHfJKTkrjzlsT5X+Tp5Pu0BLAQx/bKAwZCQ1+TWHU3bNgwbuLEiVuldDK4fftOhYuL6bybnJw8f9Sokf+UX+vwvJUahYqKjkCv9+faNHG/BCU57nCX+DPfvn37mouLiwk4sjqE/oHPDPzj8ePHyTtIDfmRiCvOK43GW/JH03Weot8SlJyMfit67CeffMJdh9nJZ1OAJTwTrk0sa8T8RDHAd9/l7vTxobscmpuHkhJ8606xKLN1TmI7+qt6VpFrEDYqSPJlYS38MUX8NxLtc/ToUVVh5XEryYJBMkcUsZkjlN/HH2P0tGn4Qvjl2DFsGjhQ5n8M4MQJbB0wAOOFcsZsHpTAihEY0WEPxEcLhpFYxnjYzpk9++mlS5dy2gL/Xb+OonbteF7I2hbO7WSMN2/qrnz66eqZ6enpmbdu3arOyMggx4p6P2RWWoq8Ll3QxyLOZIJE/nPDeoybNAnEsm53n80BlnAwIiKi3/Lly0m8JvWjgnnHjgiEhq6o0wyQK6BH4Eu7crlx40ZpmzZt6MHLfHpPeV8lwEl3YIDs70RboKrmnMZI9QSSejyJGswGNvqBu4Mk3wlgywAgTK7Wz5kzZ+CSJUtMEVBccdbR3dgcz8i1a6VZL3hthX1wiv34crSrsYIC7HvcEy8p1Weaj4ZpIMYDKK82X7t27YfDhw9viI+PX2ll8nciH/3E9Fmcewa4fOXy2c6dOxOgmzsDW2yquQrYJGAJM4zPdPDSwhk01GIWOYmaTdkBzDO26AhAVD9eIo1WE6OtRI0/lwCmiyk9Cl+/rCwfHTv+idInLxyqnk6Ke8qCgoIDEo8qo2SWHAe6i++tPwGYN7k+eXIZBn360uJ+K4uBtu4SFALgE9qJ4ker7wJOvMuecZ8kRnCF++W+ffs+HDZs2Ds0jyh5P8rs/CKaTStOhV6v72Y5u+Wl74Au/YQxS53/xUu68t+XcOlUeFD4n+uQ2K658Kno12YBSyiNjY0dEh0dTczx9E+51d4zGAyd6nB/thege7zw96Nq/JFmthCou4RT5D0YObGVQHFbgAeK9NeaGlQ7OkJ8r8kWECc/k7UnSRdzGTjTWeGpxcBXashimxAWATnbfga+62bKPuEEBvflWgcfoUMc4aVq7CqEYDq+UPV0Mr/RGocmpskPfi7ZsPiIVS4DPGVWgCmqmPhPiUicG4KQ5dakFrIVxNo0YAmTPvvssymvv/76/5pjmHFj5EZDUpqQgHCL+Z1wFsnojZG0tu/evXuzVatWf6D8JnIqUPyqFmROUpZIL+z5qmbc30g/xNlBnm+ZjEsAOKduywXz5s0ytG7dWa72mcL3pBbrIuDfeuA5QtLWrVsnh4WFrZUjKS4uLmDevHn75CMmYYnr1q1TJkK3wgihKGL6g2XPKMF10op+WJrVy5VHRkaOMBfTbCtgFesjtkSTgpa0tLT3SR4eftfj+a/2+BHAJ+d+1eI5JT9/L7y8/sylMTE9k0bUq+sV18nVgMIN0OQ1RLVYfw+A5mxBUpSOFqRGUDKJOpeXl7erb9++IbQJqKqquu7s3Ip9DIw7DXA1+/Tpw6e5Gf84sIXPT2VS6+e9N88/Li5OEYEkDZkzSXBxcfHx7t05NZuLLurUWx4DKzj8y+kcOnToHw8cOFBpjUoss5PLUGSk5zy5vbIskGeTgV4jxXQyRud/Bvn5/93n5eX1LMC0VqS4MXZlyptxHuf2TDVMHZOZmXnTct/NV8Lmd1iBNQcPHvzoxRdfnEXVoWT8I/OxGhg9DSZrKo3FRcARPcBeX0gWYAYoLjEJsbguf19Mzwl1A6WgZNnLBjYMBCbQmG0u3agxW4WM+FmzZvVftmzZt0hMnI2QkCXyU5qF93qIAcxJtuGYsnlU4TqcqYng1GTFAQxqzMW0qG5ulB8SgTkhwFLLkDi8Enh+Or3tW+XAwx3Yu/gNG7bCx+c1cXuq9NSgev6C+YMXLVqUZbn/5ilhN4Al7MnIyFgyZMiQ2QpW0XNA1cLf3w1mUpMUFeGIXs8BVv7l5+NrLy9lTKV6SBnbAlmdlWo0Jd+y0F9CAmaMGYNVNBokj4KJCqSmInb4cMSUl6PQrT0eE/vCVgGVzkA7NXHKzcVnPj7KdDzTp0/vt2rVqtNgUCsGHxHuHwoLv/EwnxLV9GSHYvUzL9iizY5Vcv5qIYRSaE2huku6kaYCmj9//rNRUYtSnekLkYLAXbt2Rb766qsW82M1B2TtCrBS0Kqsk+I/l+I0urBGILX7PuIz6k873+Qhb1dfKFXVoKCgTikpKZclaVj4meO7VvL0GDaBvStVriwrV64MmTFjxi71ya+tARzYKxbBElqJyp9HGUbpMzMP3Zc4QjBA+bXyH9zc3DzU2ouLixs2b968dOPvPNHk4ePc3NydgwYNmiq35o4f/6bnli1biLqv9p0AIMqBJZoEiWWfq27m2Elia4m/Myli9mOf7PzX4mxTsD93g8C1fSYZkGZbJB5hW7ZsWT9gwIAwecPiI4qRwj1fRUH6IoMlkprkd5sBLOti9+/zFzAz7AVs3fqDmdHrjh07tnHgwIHSZGWyCoIhKuNgxtIhQ4bMUWmPA6wUcOx/qZ0tSezp30aP/sjMvSONpyRR+CiakSVqQdTzZpzNHRkw1TpJeA9ndl2/fv24SZMmSVPrAJg3b96zcXFxJGSR+pnOnLJTJwEW6xwkJ7+2FnBQT/5GKhUi06qQNbnuTsIcyGVRZWVJ1tmzqbt27dpg7asM4gTtCr7m5SVB5YGx6OhoQ2xsbDo1ZlrMsWIcR3eVsM8mgSa9E5sBbEJCwvQxr41ZSYRx/PjxllZ0Hc6d241evUaIl2u1lTssLMxjK2URIGfYRwF/GhMKCrDf0xMKt8XychS4uZlc4ihsVVg4S4G8LqB75UyejF7r1oEYWqhfZWVlcdu2wt2pqQhrgDPmBDaCTy04QNJ2NXBX+dofA5PRxrSCFZdwIXpmZbQUeRC8jiirUkTELN+vvvrq3COPPELyOrNNGQwGZGZmktKEZos7qrx/cyGDOH8+Fd7ef1GjOSAArunpLM+V4ZBCpQLsB2X+mxGr3ILa3AQI/d+8efNK69athbdGq19++eWu/ANIaiQ6FqP4aHd0ZyNF2E8FsSVAjjs9p+9RMHiWxoXruH6xHdrpFZ3fv38HLVo4m9HrlLmdbty4hDZtutDU6CAEdUtByiW1QYofgBYPUWwxN449Be9hpIVX60nhkpITUGS1IIA17bACKxctWjRs/vz5+83JyT3cu9USLV0UZVgYMnhmYKP4EqvmsSpAwX5PeFJ9xAUaWfvAwYM/4OGH2WATqeiw/0VS8agmrW8u3NgKYB3AMDV8Qh6WFzeA0oHe3npzr4eRVfZEYeF/XGnZAmWTEBER8dTy5ctPyRityHYhPnINHTq0rfhVbi4l62mF2V9cx2CQhsqR/i7h0ndd0bWf1PmfWy7lfcgFgeSp+nzHjh+5iTJ/NgwJCXkkMTHxZ0vClJSU9G5wcHCcpJwpNlf8Z7L7kXtgs4EVV69e/W+HDh1E11kmOsmYn/V7Vi15nCVSLf2u3JkZoOD7ggxPT/UXIoRGpe/0KLzo/g3+btoSEU35uw0BVno1QGbiNJDU18IbnbwllYTltTVjzMCFCzjcs6c0NUgxkN0dGKha7zouDg0Z2vfAgQM3nnvuudarj67e1A/92DtTtTq0ZxyN/r6UmVW73xQVJTsJ8ayy5l1UauZGebd8xkA27lN17NwP4kelVOUyPT39g4CAgHnyxjg0Mejl3atRnm2kJhJg+7QuLzE/ICroS3RUv/CmxCa1L1sBLDuzRuERS9GKFcGYOZN93U3tCwoK6pryZcpFOMqEWlThMnC2s+lFM+6XC/gGPfB8ne8QzawMNMB++umn4ePGjVsjp59vxmIKUHOA5zFB3PorIMscYYZlxJwqub6hlc0C1vnD8sPP8zDPLw5xZEeSZLZhkxFwwQ2N9SavIosGN46iLEA/yAp0SbzWxNN64cKFwz2lWSusaK7xi9gSYCXxjcahc5nxlfmE5byZPbs/li4l1wuyzzgNytfaiouzwXr48GWk/ydagAU2Kcyc8qqkjkI4TVcQYqXY2JZFN7yYmJjnY2JivlH3JgKQm5sAH5/XrRaZW7euCuc3I+iNT71ytMUi9sVoWH6ak7M8769UeBSxq3Aj5CXmB3kTN6+0hmD3MM1NMYqPd5cGSFDZEhYW9tiWrVsLOQcy6dxsxpa338Sbn1jNzyYqaEuAzYPMkiqCB8khS1znLD63qLr5leAk3KWhb1xQ96h/UuuY068pUBYJvWLHlKdckamOFudALVOjWEasMQ6Jy8fHxw+fO3fuV1Q5M43d4u7P11f1dmqUzP98p+VAgZsoiN00Fot5iUlRMjai8ksfT+PGTuSMPJpm2R+9iYAqdGNRWJqQHnaHpdyzCyQsAaD6Yri5oG++ARIbKkmnavZqQDRw1ag+OnMUPDUDOKuuYfhuSAoTNuKHtpZYMl5RSFWN0xWVtRawUtVS8rQPu8Na1CLqI2dFRUVH9YqE4qQl9TeU+H7IuEieLf7NI2nvGchYOgSqd+P+cxMAAAjfSURBVPf1IbXB6tgMYJOQ9G4wiOVSsAEQ0sT/BhYuXDgkKirqIG30GzduDJswYcIWzptISA9i8g46hEPLB2OwyRfZ2Ej+XuCJP5vqCKYSYwIY0e2XTCWWPJhFLNu60jZQfbFbIEy0P9+/DbS06rGl3NzcHT4+T42mqZ3k9O/dqz6GnSvngE7e3H0OIcv0pmslKunXWiqix9/iKnQPXiVuFMAiN/cz+Pjwrx6avMhO4VRiP/RT5FomxLEGt88+O4xupkfTOKJNc+sPf9csNOhre78/wKr5zcpPjSODgjrTAo+LgWPdxdn7ZCxSu/Igu+yxwmPn2sPtMePqZYU6rJgBBsj9Dgk+PqCeI4XE3BLRqEIlnNX9fsV9jB07tse2bdvIg1eK7yRObusP1fxTqsJyHue/8oa39OFjfuxTpkzpu2bNGhJ7a+2ntLaazrCNAtjdu3fPGzlyJHmYS/pdunQKXQVAGn9yiEXsC9GIJknGTc9LyuZ640aMnzABshxZ1rKg8cvZzA5Lhrp+PcZOmohPlYmdJYwo1ev1PcUZCfz9/dsdycqqUBtMIXDIA5AnljY2Stwi33nnnXFBYWH/ULzgbi14Kyp+9H3ppSdycnKo6WBqgRoH7h1Y03e7TpZdAevS/YABxrw+Rp+QkECutur0jRkzpmdCQoKaG2idQMYwfGpWmeGuMXdYSXyvZOQMDAbuCU9yVo2Pjw+cMWNuQqtW0rzMCmYdwWoMwrQ6MbGJC9sUYMnY2actJOFQFMtsaelpj0GDBhjfZOUspFwIlQJgDCYjvNc6rFN1/xPznOy4jz76aOuWLVs6/Prrr9VOTk73KyoqGFdXVzZo3MnJiamurmb5xv+75qeffrpfWFhIQtSouwzfvimtDE/orVu3yx9++OEO1s651KNIMtA6gUvUn+jsaWrvBm6UtoFKPisVYnk/Kf6GTIRaMBg7blzP8vLymzU1NTonJyd20XJ2dtZVVVURnNcIfC4rK7t3/vx5suCZ46ORAnFGSrkF/cyZs8lVT1b96gvf1x344AmlfJjGfARHVg/CIPJihFV9WztnDV3O5gBLVsQiFGXq2VxLyo+3wAO66xfDwiKGvPLKK6HE0isvaSpn3eV/QzNW3l4l8FNb+Rs+N1GG1mb8WWWNXLp06buuXbtyicdMH3kxj54szppB3cY1uMBVxC/s3Lnz76NHj15mTXWhTFFR0RG9MTWquCYHZdrHWil4U4X432VlZecXLFgQsm4ddZElBiPSIhMSEuKemJh4UUy7+N8W6efxmpCQMGPMmDHUEEeLbTRxAVsELPtURHJyTrZqClKpPJhyj1Gdo6OeB5r/6YVfgct/kDub/4or+ANIKhervlWrVoVMnzb9C/H7seFTuLdarWqAUujsWST3lqXJMfMOrWo3H374YcC7775LHiozfmZPExTFiVSU1ZFaqQtwAJ4YQimnPnxRgxR6aufNg39cHFSjm+rL18aqZ5OAJYNlr0KSk49KndSVsyyZBOWMEDVVmTissbhprt0LF75Bzx7Pi+Mt6qF6klfiaoxuHNz1iVXuiGqk8cnb5e/a1kcuSBaL+xKfZyu3O+Ucsn8hT4WIFzNR++aDasWwNyMfP44YMWIA7amX5hAPa/usz8RY2/ZvLseC9ssvD8O9+0DxrmLBKMX1ywA7v6i7avebiVZrYMOGcZgwYas4wOH69esX27WjRASZIeIGblxqgzZdSJEqVN1wVj6OVZ8hsEor+Z/TeXlJfVViSa1omH16klqOnhVEpUkGOKHbClEi9Lfffttj06ZN9CB62UItDcCndJGPNN/XfUepGQitGGezFbFpwAo77Zc5OYeJk76CSxQdR/SnKm9v7z+ai/ZpSq7TXgAoKyvL70jPY6xK2qxZs55etmwZ8fyC2pu0dR3XIRxaNhiDI0i9gICA9unp6eRhr7p/+/AhhuEdcUWqWmxWV+YWjjfHw3PLFpgAuhvzMBLKKxy+M2v7ycrKWufv709eZ7Bp45Ia820esDzhTudxPllxZyieLNmMLV68eHhkZCS5c7OhrzQP6GJ8XkJ4v7WOBOqqgApnBm2DRgZ1S0lRj6W1tl2Zl5i13k2K5omF/bvCwovsWd0CKI2VqeXYLBdE1TeCSkh3qzAwqW3noogOUqf86tWCOXPmBNISGVjLJ1soZy+AJbzSpaWlxbLpTo0+OSrk5+d/DS+vl22BwWIaDAZD24zMzKuOfKgcn/iM+FDX6WP9gP/+92Q4OpJY1QbZKUpLS/Pu3LlT+VsjVDhN4ssTQEfeR7cOujAP3vT09LiAgID3xExRc6wxlZHaN0xJcBkkJ+/+x6hRo0j8b73f8qnTBDViYXsCLMsG/sX2Q4r4UJ5JJGvgYD+/rla+z9KIrKU3HRUVNWjh+wsP8xtAvQ1G/MsAygTeTT4iZYdkpz1woPAAyUip2ECt2Hm9ZU9qinpQCafjShh3XzC4fUdXsWnTqvCEhISvbFUW6jNVdgdYMsjQ0FD37du3Fzo58e+/iBbx0NDQ7jt27GCfd7TVLyoq6oWFC18cBapvs61SXXe6iN9uaGjoqMmTJ2/jkrtJ80aJgyoEHKempsYOHz48htYbyfixf//+Ex07dvQWfq+pqbmXlpa2aMWKFauvXr1a5erqqisqKqq2/DZP3cdjCzXsErCEccSCHJkTOW00Rn/EufgD06dN7/Pxxx+fsQXGajRIOKDT6/Wt2rdv73Dt2rVaFxeX2tu3bzsQTzGhVMuWLRkrvZwcvL29nYT6VniY/a6mwm4BK5oFJ29vbwcygb/XVfV3JXHaYH4TB34PgP1NDNAqaxywJw5ogLWn2dJofeA5oAH2gRcBjQH2xAENsPY0WxqtDzwHNMA+8CKgMcCeOKAB1p5mS6P1geeABtgHXgQ0BtgTBzTA2tNsabQ+8BzQAPvAi4DGAHvigAZYe5otjdYHngMaYB94EdAYYE8c0ABrT7Ol0frAc0AD7AMvAhoD7IkDGmDtabY0Wh94DmiAfeBFQGOAPXFAA6w9zZZG6wPPgf8HevrZRCeOG2MAAAAASUVORK5CYII="
                                                        id="svg_1" height="98" width="236" y="-16" x="-25"/>
                                                    <text transform="matrix(1.68301 0 0 1.75 -51.8021 -61.875)"
                                                          stroke="#000"
                                                          font-style="normal"
                                                          font-weight="normal" xml:space="preserve" text-anchor="start"
                                                          font-family="'Harlow Solid Italic'"
                                                          font-size="10" id="svg_3" y="82.92857" x="61.5836"
                                                          fill-opacity="null"
                                                          stroke-opacity="null"
                                                          stroke-dasharray="null"
                                                          stroke-width="0" fill="#000000">Solutions in Web</text>
                                                </g>
                                            </svg>
                                        </a>
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>

                                    {{-- Display Registration Errors --}}
                                    @if(count($errors) > 0 )
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <ul class="p-0 m-0" style="list-style: none;">
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form class="user" method="POST" action="{{route('register')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="first_name"
                                                       class="form-control form-control-user"
                                                       id="exampleFirstName"
                                                       placeholder="First Name"
                                                       value="{{old('first_name')}}"
                                                >
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="last_name"
                                                       class="form-control form-control-user"
                                                       id="exampleLastName"
                                                       placeholder="Last Name"
                                                       value="{{old('last_name')}}"
                                                >
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                   id="exampleInputEmail"
                                                   placeholder="Email Address"
                                                   value="{{old('email')}}"
                                            >
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="password"
                                                       class="form-control form-control-user"
                                                       id="exampleInputPassword" placeholder="Password"
                                                       value="{{old('password')}}">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="password_confirmation"
                                                       class="form-control form-control-user"
                                                       id="exampleRepeatPassword" placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Register Account
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/password-reset">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

