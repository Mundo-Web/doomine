import { createRoot } from "react-dom/client";
import React, { useEffect, useState } from 'react'
import axios from "axios";




export default function Catalogo(props) {
  const take = 12

  const general = JSON.parse(props.general);
  const faqs = JSON.parse(props.faqs);
  const categorias = JSON.parse(props.categorias);
  const testimonie = JSON.parse(props.testimonie);
  const filtro = JSON.parse(props.filtro);
  const categoria = JSON.parse(props.categoria);
  const atributos = JSON.parse(props.atributos);
  const colecciones = JSON.parse(props.colecciones);
  const appUrl = props.appurl;




  const selected_category = Number(filtro)


  const [items, setItems] = useState([])
  const [filter, setFilter] = useState({ category_id: [selected_category] })
  const [totalCount, setTotalCount] = useState(0)
  const [currentPage, setCurrentPage] = useState(1)
  const [namebtn, setNamebtn] = useState('Cargar más modelos')
  const [loading, setLoading] = useState(true)

  const [priceOrder, setPriceOrder] = useState('')
  const [selectedPriceRanges, setSelectedPriceRanges] = useState([]);
  const [selectedOption, setSelectedOption] = useState('');

  const [isListVisible, setIsListVisible] = useState(false);

  const toggleListVisibility = () => {
    setIsListVisible(!isListVisible);
  };

  const [isModalOpen, setIsModalOpen] = useState(false);
  const showModal = (e) => {
    e.preventDefault();
    setIsModalOpen(true);
  };

  const closeModal = (e) => {
    e.preventDefault();
    setIsModalOpen(false);
  };

  let abortController = new AbortController();

  const handleOptionChange = (event) => {
    setIsListVisible(!isListVisible);
    setSelectedOption(event.target.value);
    setPriceOrder((prevFilter) => {
      return event.target.value
    })
    console.log(`Selected option: ${event.target.value}`);
  };

  const handlePriceRangeChange = (event) => {
    const { value, checked } = event.target;


    let [minPrice, maxPrice] = value.split('_').map(Number);
    document.querySelectorAll('.changePrice').forEach((checkbox) => {
      checkbox.checked = false;
    });

    // Marcar solo la opción seleccionada
    event.target.checked = checked;

    setFilter((prevFilter) => {

      // let updatedPriceRanges = prevFilter.priceRanges || [];


      if (checked) {
        //  updatedPriceRanges = [...updatedPriceRanges, { minPrice, maxPrice }];
        return { ...prevFilter, minPrice, maxPrice };

      } else {
        //quitamos minPrice y maxPrice del objeto
        delete prevFilter.minPrice
        delete prevFilter.maxPrice


        return prevFilter;
      }

    });
  };

  const handleTallaChange = (event) => {
    const { value, checked, id } = event.target;


    const idclean = id.toLowerCase().replace('talla_', '')


    setFilter((prevFilter) => {
      let updatedSizes = prevFilter.sizes || [];

      if (checked) {
        updatedSizes = [...updatedSizes, idclean];
      } else {
        updatedSizes = updatedSizes.filter((size) => size !== idclean);
      }

      return { ...prevFilter, sizes: updatedSizes };
    });
  }

  const changeCollection = (event) => {
    const { value, checked, id } = event.target;



    let idClean = id.replace('collection_', '')


    setFilter((prevFilter) => {
      let updatedCollections = prevFilter.collections || [];

      if (checked) {
        updatedCollections = [...updatedCollections, Number(idClean)];
      } else {
        updatedCollections = updatedCollections.filter((collection) => collection !== Number(idClean));
      }

      return { ...prevFilter, collections: updatedCollections };
    });
  }


  const handleColorChange = (event) => {
    const { value, checked, id } = event.target;






    setFilter((prevFilter) => {
      let updatedColors = prevFilter.colors || [];

      if (checked) {
        updatedColors = [...updatedColors, Number(id)];
      } else {
        updatedColors = updatedColors.filter((color) => color !== Number(id));
      }

      return { ...prevFilter, colors: updatedColors };
    });
  }


  useEffect(() => {
    const queryParams = new URLSearchParams(window.location.search);
    const priceOrderParam = queryParams.get('priceOrder');
    if (priceOrderParam) {
      setPriceOrder(priceOrderParam);
    }
    // getItems()
  }, [null]);


  useEffect(() => {
    setCurrentPage(1)
    getItems()

  }, [filter])

  useEffect(() => {
    getItems()
  }, [currentPage])
  useEffect(() => {
    setCurrentPage(1)
    getItems()
  }, [priceOrder])

  const arrayJoin = (array = [], separator) => {
    const newArray = []
    array.forEach((x, i) => {
      if (i == 0) {
        newArray.push(x)
      } else {
        newArray.push(separator, x)
      }
    })
    return newArray
  }
  const handleCheckboxChange = (itemId) => {
    const isChecked = filter.category_id.includes(itemId);
    setFilter((filter) => {
      // const isChecked = filter.category_id.includes(itemId);

      if (isChecked) {
        // Si ya está seleccionado, lo eliminamos del array
        return {
          ...filter,
          category_id: filter.category_id.filter((id) => id !== itemId),
        };
      } else {
        // Si no está seleccionado, lo agregamos al array
        return {
          ...filter,
          category_id: [...filter.category_id, itemId],
        };
      }
    });
  };


  const getItems = async () => {


    abortController.abort('some');
    abortController = new AbortController();
    let signal = abortController.signal;

    setNamebtn('Cargando ...')



    const filterBody = []
    let sort = [];
    console.log(priceOrder)
    if (priceOrder) {
      if (priceOrder === 'price_high') {
        sort.push({
          selector: 'products.preciofiltro',
          desc: true
        });
      } else if (priceOrder === 'price_low') {
        sort.push({
          selector: 'products.preciofiltro',
          desc: false
        });
      } else {
        sort.push({
          selector: 'products.created_at',
          desc: true
        });
      }



    }


    if (filter.maxPrice || filter.minPrice) {
      if (filter.maxPrice && filter.minPrice) {
        filterBody.push([
          [
            ['preciofiltro', '>=', filter.minPrice]
          ],
          'and',
          [
            ['preciofiltro', '<=', filter.maxPrice]
          ]
        ]);
      } else if (filter.minPrice) {
        filterBody.push([
          ['precio', '>=', filter.minPrice],
          'or',
          ['descuento', '>=', filter.minPrice]
        ]);
      } else if (filter.maxPrice) {
        filterBody.push([
          ['precio', '<=', filter.maxPrice],
          'or',
          ['descuento', '<=', filter.maxPrice]
        ]);
      }
    }


    if (filter['collections'] && filter['collections'].length > 0) {
      const sizeFilter = [];
      filter['collections'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['collection_id', '=', x]);
        } else {
          sizeFilter.push('or', ['collection_id', '=', x]);
        }
      });

      filterBody.push(sizeFilter);
    }
    if (filter['sizes'] && filter['sizes'].length > 0) {
      const sizeFilter = [];
      filter['sizes'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['combinaciones.talla_id', '=', x]);
        } else {
          sizeFilter.push('or', ['combinaciones.talla_id', '=', x]);
        }
      });

      filterBody.push(sizeFilter);
    }
    if (filter['colors'] && filter['colors'].length > 0) {
      const sizeFilter = [];
      filter['colors'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['combinaciones.color_id', '=', x]);
        } else {
          sizeFilter.push('or', ['combinaciones.color_id', '=', x]);
        }
      });

      filterBody.push(sizeFilter);
    }


    if (filter['category_id'] && filter['category_id'].length > 0) {
      const categoryFilter = [];

      filter['category_id'].forEach((x, i) => {
        if (i === 0) {
          categoryFilter.push(['categoria_id', '=', x]);
        } else {
          categoryFilter.push('or', ['categoria_id', '=', x]);
        }
      });

      filterBody.push(categoryFilter);
    }


    const result = await axios.post('/api/products/paginate', {
      requireTotalCount: true,
      filter: arrayJoin([...filterBody, ['products.visible', '=', true]], 'and'),
      take,
      skip: take * (currentPage - 1),
      sort
    }, {
      headers: {
        'Content-Type': 'application/json'
      },
      signal: signal
    });


    const { data, totalCount: totalRegistros } = result.data
    if (currentPage == 1) {
      setItems(data ?? [])
    } else {
      setItems([...items, ...data])
    }
    setNamebtn('Cargar más modelos')
    setTotalCount(totalRegistros ?? 0)

    let registrosCargados = take * currentPage
    console.log(registrosCargados, totalRegistros)

    if (registrosCargados >= totalRegistros) {

      setLoading(false)
    }


  }

  return (<>
    <div className="w-11/12 mx-auto mt-10">
      <div className="grid grid-cols-2 row-span-2 md:grid-cols-4 lg:row-span-1 gap-2 md:gap-0">
        <div className="order-3 md:order-1 flex justify-between md:pr-2 items-center">
          <p className="font-boldDisplay text-[20px] xl:text-text28 hidden md:block">
            Categorías
          </p>
          <div className="flex justify-center items-center open">
            <img src={appUrl + '/images/svg/catalogo_filtro_icon.svg'} alt="logo_filtros" onClick={showModal} />
          </div>
        </div>
        <form id="FilterForm" method="post" action="" className="hidden">

          <input type="hidden" name="categories_id" value="{{ $filtro }}" id="get_categories"
            data-filtro=".changeCategory" />
          <input type="hidden" name="precio_id" id="get_precios" data-filtro=".changePrice" />
          <input type="hidden" name="talla_id" id="get_tallas" data-filtro=".changeTallas" />
          <input type="hidden" name="color_id" id="get_colores" data-filtro=".changeCollection" />
          <input type="hidden" name="coleccion_id" id="get_colecciones" data-filtro=".changeColor" />
          <input type="hidden" name="orderPrice" id="orderPrice" />
        </form>
        <div className="md:pl-9 order-1 md:order-2 flex items-center">
          <h3 className="font-boldItalicDisplay text-text20 md:text-text24 text-left w-full lg:w-auto">
            {filtro == 0 ? (
              // Productos
              <div>Productos</div>
            ) : (
              categoria.name
            )
            }


          </h3>
        </div>

        <div className="flex items-center gap-2 order-4 md:order-3 justify-end md:pr-5">
          <p className="text-[#CCCCCC] font-regularDisplay text-text14 md:text-text18">
            Mostrando <span>1</span>-<span>20</span> de
            <span>100</span> productos
          </p>
        </div>

        <div className="dropdown w-full order-2 md:order-4">
          <div
            className="input-box focus:outline-none font-mediumDisplay text-text16 md:text-text20 mr-20 shadow-md px-2 bg-[#F5F5F5]"
            onClick={toggleListVisibility}
          >
            Ordenar por
          </div>

          {isListVisible && (
            <div className="list z-[100] animate-fade-down animate-duration-[2000ms]" style={{ maxHeight: '150px', boxShadow: 'rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px' }}>
              <div className="w-full">
                <input type="radio" name="drop1" id="id11" className="radio" value="price_high" onChange={handleOptionChange} />
                <label
                  htmlFor="id11"
                  className="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar"
                >
                  <span className="name inline-block w-full">Precio más alto</span>
                </label>
              </div>

              <div className="w-full">
                <input type="radio" name="drop1" id="id12" className="radio" value="price_low" onChange={handleOptionChange} />
                <label
                  htmlFor="id12"
                  className="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar"
                >
                  <span className="name inline-block w-full">Precio más bajo</span>
                </label>
              </div>

              <div className="w-full">
                <input type="radio" name="drop1" id="id13" className="radio" value="more_old" onChange={handleOptionChange} />
                <label
                  htmlFor="id13"
                  className="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white comentar"
                >
                  <span className="name inline-block w-full">Antiguo</span>
                </label>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>


    <div className="flex flex-col md:flex-row md:gap-10 w-11/12 mx-auto font-poppins">
      <aside className="flex flex-col gap-10 md:basis-3/12" >

        <div className="hidden-categoria-precio">
          <div className="hidden md:flex flex-col gap-10 show-categoria-precio">
            <div className="flex flex-col gap-2 text-text18 xl:text-text20">
              <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                <a href="/catalogo/0" className="{{ $filtro == 0 ? 'font-semibold underline' : 'text-black' }}">Todas</a>
              </div>
              {categorias.map((item) => (
                <div key={item.id} className="flex justify-start gap-2 items-center w-full">
                  <input
                    type="checkbox"
                    value={item.id}
                    className="changeCategory"
                    checked={filter.category_id.includes(item.id)}
                    onChange={() => handleCheckboxChange(item.id)}
                    id={"categoria_" + item.id}
                  />
                  <label
                    htmlFor={"categoria_" + item.id}
                    className="font-boldDisplay flex justify-start gap-2 items-center w-full"
                  >
                    {item.name}
                  </label>
                </div>
              ))}


            </div>

            <div>
              <div className="relative">
                <div className="mx-auto">
                  <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                    <details className="group">
                      <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                        <span className="font-boldDisplay text-text20 text-[#151515]">
                          Precio
                        </span>
                        <span className="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div className="group-open:animate-fadeIn mt-5">
                        <div className="flex flex-col gap-2 text-text18 xl:text-text20">

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="0_50" className="changePrice" id="price_0_50" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_0_50" className="cursor-pointer">
                              S/0 - S/50
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="50_100" className="changePrice" id="price_51_100" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_51_100" className="cursor-pointer">
                              S/50 - S/100
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="100_150" className="changePrice" id="price_101_150" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_101_150" className="cursor-pointer">
                              S/100 - S/150
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="150_200" className="changePrice" id="price_151_200" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_151_200" className="cursor-pointer">
                              S/150 - S/200
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="200_100000" className="changePrice" id="price_200_more" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_200_more" className="cursor-pointer">
                              S/200 - Más
                            </label>
                          </div>
                        </div>
                      </div>
                    </details>
                  </div>
                </div>
              </div>
            </div>

            {atributos.map((item) => {
              let nametypeatributo = item.type_attribute.name;

              return nametypeatributo === 'Color' ? (
                // Aquí puedes poner el código que deseas renderizar si es 'Color'
                <div>
                  <div className="relative">
                    <div className="mx-auto">
                      <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                        <details className="group">
                          <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                            <span className="font-boldDisplay text-text20 text-[#151515]">
                              {item.titulo}
                            </span>
                            <span className="transition group-open:rotate-180">
                              <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                  d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                                  fill="black" />
                                <path
                                  d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                                  fill="black" />
                              </svg>
                            </span>
                          </summary>

                          <div className="group-open:animate-fadeIn mt-5">
                            <div className="grid grid-rows-1 gap-4 place-items-start">
                              {item.attribute_values && item.attribute_values.length > 0 && (
                                item.attribute_values.map((valores) => {


                                  return (
                                    <div key={valores.id} className="flex flex-row justify-start items-center text-center gap-2">
                                      <input type="checkbox" onChange={handleColorChange} id={valores.id} className="changeColor rounded-full cursor-pointer" data-val="0" style={{ backgroundColor: valores.color }} />
                                      <span className="block w-5 h-5 rounded-full transition"></span>

                                      <span>{valores.valor}</span>
                                    </div>
                                  );
                                })
                              )}





                            </div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div>
                </div>
              ) : (
                <div>
                  <div className="relative">
                    <div className="mx-auto">
                      <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                        <details className="group">
                          <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                            <span className="font-boldDisplay text-text20 text-[#151515]">
                              {item.titulo}
                            </span>
                            <span className="transition group-open:rotate-180">
                              <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                  d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                                  fill="black" />
                                <path
                                  d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                                  fill="black" />
                              </svg>
                            </span>
                          </summary>

                          <div className="group-open:animate-fadeIn mt-5">
                            <div className="flex flex-col gap-2 text-text18 xl:text-text20">

                              {item.attribute_values && item.attribute_values.length > 0 && (
                                item.attribute_values.map((valores) => {
                                  return (
                                    <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">

                                      <input type="checkbox" value={valores.valor} className="changeTallas"
                                        onChange={handleTallaChange}
                                        id={item.titulo + '_' + valores.id} />
                                      <label htmlFor="talla_{{ $valores->id }}"
                                        className="font-boldDisplay flex justify-start gap-2 items-center w-full">
                                        {valores.valor}
                                      </label>
                                    </div>
                                  )
                                }))}
                            </div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div >
                </div >
              );
            })}



            < div >
              <div className="relative">
                <div className="mx-auto">
                  <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                    <details className="group">
                      <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                        <span className="font-boldDisplay text-text20 text-[#151515]">
                          Colecciones
                        </span>
                        <span className="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div className="group-open:animate-fadeIn mt-5">
                        <div className="flex flex-col gap-2 text-text18 xl:text-text22" >
                          {colecciones.map((item) => {
                            return (
                              <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                                <input type="checkbox" id={"collection_" + item.id} value="{{ $item->id }}"
                                  className="w-4 h-4 accent-[#000000] cursor-pointer " onClick={changeCollection} />
                                <label htmlFor="collection_{{ $item->id }}" className="cursor-pointer">
                                  {item.name}
                                </label>
                              </div>
                            )
                          })}


                        </div>
                      </div>
                    </details>
                  </div>
                </div>
              </div>
            </div >
          </div >
        </div>
      </aside>

      <div className={`modal-filtros z-[100] ${isModalOpen ? 'modal--show-filtro' : ''}`} style={{ display: isModalOpen ? 'flex' : 'none' }}>
        <div className="modal__mostrar-filtro">
          <div className="flex justify-between">
            <p className="font-boldDisplay text-[20px]">Categorías</p>
            <a href="#" className="modal__close-filtro" onClick={closeModal}>
              <img src={`${appUrl}/images/svg/close.svg`} alt="close" />
            </a>
          </div>
          <div className="overflow-y-scroll h-[500px] scroll__categorias">
            <div className="addCategoriaPrecio flex flex-col gap-5"></div>
            <div className="flex flex-col gap-2 text-text18 xl:text-text20">
              <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                <a href="/catalogo/0" className="{{ $filtro == 0 ? 'font-semibold underline' : 'text-black' }}">Todas</a>
              </div>
              {categorias.map((item) => (
                <div key={item.id} className="flex justify-start gap-2 items-center w-full">
                  <input
                    type="checkbox"
                    value={item.id}
                    className="changeCategory"
                    checked={filter.category_id.includes(item.id)}
                    onChange={() => handleCheckboxChange(item.id)}
                    id={"categoria_" + item.id}
                  />
                  <label
                    htmlFor={"categoria_" + item.id}
                    className="font-boldDisplay flex justify-start gap-2 items-center w-full"
                  >
                    {item.name}
                  </label>
                </div>
              ))}


            </div>

            <div>
              <div className="relative">
                <div className="mx-auto">
                  <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                    <details className="group">
                      <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                        <span className="font-boldDisplay text-text20 text-[#151515]">
                          Precio
                        </span>
                        <span className="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div className="group-open:animate-fadeIn mt-5">
                        <div className="flex flex-col gap-2 text-text18 xl:text-text20">

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="0_50" className="changePrice" id="price_0_50" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_0_50" className="cursor-pointer">
                              S/0 - S/50
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="50_100" className="changePrice" id="price_51_100" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_51_100" className="cursor-pointer">
                              S/50 - S/100
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="100_150" className="changePrice" id="price_101_150" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_101_150" className="cursor-pointer">
                              S/100 - S/150
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="150_200" className="changePrice" id="price_151_200" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_151_200" className="cursor-pointer">
                              S/150 - S/200
                            </label>
                          </div>

                          <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="200_100000" className="changePrice" id="price_200_more" onChange={handlePriceRangeChange} />
                            <label htmlFor="price_200_more" className="cursor-pointer">
                              S/200 - Más
                            </label>
                          </div>
                        </div>
                      </div>
                    </details>
                  </div>
                </div>
              </div>
            </div>

            {atributos.map((item) => {
              let nametypeatributo = item.type_attribute.name;

              return nametypeatributo === 'Color' ? (
                // Aquí puedes poner el código que deseas renderizar si es 'Color'
                <div>
                  <div className="relative">
                    <div className="mx-auto">
                      <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                        <details className="group">
                          <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                            <span className="font-boldDisplay text-text20 text-[#151515]">
                              {item.titulo}
                            </span>
                            <span className="transition group-open:rotate-180">
                              <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                  d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                                  fill="black" />
                                <path
                                  d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                                  fill="black" />
                              </svg>
                            </span>
                          </summary>

                          <div className="group-open:animate-fadeIn mt-5">
                            <div className="grid grid-rows-1 gap-4 place-items-start">
                              {item.attribute_values && item.attribute_values.length > 0 && (
                                item.attribute_values.map((valores) => {


                                  return (
                                    <div key={valores.id} className="flex flex-row justify-start items-center text-center gap-2">
                                      <input type="checkbox" onChange={handleColorChange} id={valores.id} className="changeColor rounded-full cursor-pointer" data-val="0" style={{ backgroundColor: valores.color }} />
                                      <span className="block w-5 h-5 rounded-full transition"></span>

                                      <span>{valores.valor}</span>
                                    </div>
                                  );
                                })
                              )}





                            </div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div>
                </div>
              ) : (
                <div>
                  <div className="relative">
                    <div className="mx-auto">
                      <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                        <details className="group">
                          <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                            <span className="font-boldDisplay text-text20 text-[#151515]">
                              {item.titulo}
                            </span>
                            <span className="transition group-open:rotate-180">
                              <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                  d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                                  fill="black" />
                                <path
                                  d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                                  fill="black" />
                              </svg>
                            </span>
                          </summary>

                          <div className="group-open:animate-fadeIn mt-5">
                            <div className="flex flex-col gap-2 text-text18 xl:text-text20">

                              {item.attribute_values && item.attribute_values.length > 0 && (
                                item.attribute_values.map((valores) => {
                                  return (
                                    <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">

                                      <input type="checkbox" value={valores.valor} className="changeTallas"
                                        onChange={handleTallaChange}
                                        id={item.titulo + '_' + valores.id} />
                                      <label htmlFor="talla_{{ $valores->id }}"
                                        className="font-boldDisplay flex justify-start gap-2 items-center w-full">
                                        {valores.valor}
                                      </label>
                                    </div>
                                  )
                                }))}
                            </div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div >
                </div >
              );
            })}



            < div >
              <div className="relative">
                <div className="mx-auto">
                  <div className="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                    <details className="group">
                      <summary className="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                        <span className="font-boldDisplay text-text20 text-[#151515]">
                          Colecciones
                        </span>
                        <span className="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div className="group-open:animate-fadeIn mt-5">
                        <div className="flex flex-col gap-2 text-text18 xl:text-text22" >
                          {colecciones.map((item) => {
                            return (
                              <div className="font-regularDisplay flex justify-start gap-2 items-center w-full">
                                <input type="checkbox" id={"collection_" + item.id} value="{{ $item->id }}"
                                  className="w-4 h-4 accent-[#000000] cursor-pointer " onClick={changeCollection} />
                                <label htmlFor="collection_{{ $item->id }}" className="cursor-pointer">
                                  {item.name}
                                </label>
                              </div>
                            )
                          })}


                        </div>
                      </div>
                    </details>
                  </div>
                </div>
              </div>
            </div >
          </div>
        </div>
      </div>


      <div id="getProductAjax" className="grid gap-10">
        <section className="md:basis-9/12 flex flex-col gap-10">
          <div className="grid grid-cols-2 lg:grid-cols-3 gap-5 z-[0]">
            {items.map((item, i) => {

              let caratula = item.images.find(image => image.caratula === 1)
              if (!caratula) { caratula = item.images[0] }
              if (!caratula) { caratula = {} }
              return (



                <div className="flex flex-col gap-5 relative col-span-1 order-1 lg:order-1">
                  <div className="product_container">
                    {

                      <img src={appUrl + '/' + caratula.name_imagen} alt={caratula.name}
                        className="w-full h-full hover:scale-110 transition-all duration-300 border-none" onError={(e) => e.target.src = '/images/img/noimagen.jpg'} />

                    }


                    <div className="addProduct text-center flex justify-center">

                      <a href={appUrl + "/producto/" + item.id}
                        className="leading-none font-mediumDisplay text-text12 md:text-text14 bg-[#000000] px-1 py-2 md:py-2 2lg:px-5 flex-initial w-32 md:w-36 2lg:py-3 2lg:w-52 text-center text-white rounded-3xl xl:text-text20 xl:w-60">
                        Ver producto
                      </a>
                    </div>
                  </div>

                  <div className="flex flex-col gap-1">
                    <div
                      className="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-1 order-2 lg:order-1">
                      <p className="text-text14 md:text-text16 xl:text-text20">
                        {item.producto}
                      </p>
                      <div className="flex flex-col md:flex-row font-boldDisplay text-black items-start gap-1">
                        {item.descuento === 0 ? (
                          <p className="text-text14 md:text-text16 xl:text-text20">
                            s/{item.precio}
                          </p>
                        ) : (
                          <div className="flex flex-row gap-2">
                            <p className="text-text14 md:text-text16 xl:text-text20">
                              s/{item.descuento}
                            </p>
                            <p className="text-text10 md:text-text16 line-through text-gray-400 font-mediumDisplay xl:text-text18">
                              s/{item.precio}
                            </p>
                          </div>
                        )}

                      </div>
                    </div>

                    <div className="order-1 lg:order-2">
                      <p className="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                        {item.categoria && item.categoria.name ? (
                          item.categoria.name
                        ) : (
                          'S/C'
                        )}
                      </p>
                    </div>
                  </div>

                  <div className="absolute top-[10px] left-[10px] md:top-[10px] md:left-[10px]">
                    <div className="flex gap-3 flex-wrap">
                      <span
                        className="bg-red-800 text-xs md:text-sm text-white me-2 px-2.5 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300 shadow-2xl"
                      >
                        {Math.round(((item.precio - item.descuento) * 100) / item.precio)}% <br className="block md:hidden" /> OFF
                      </span>


                    </div>
                  </div>
                </div>


              )
            })}
          </div>


        </section>

      </div>
    </div >
    <div className="flex justify-center items-center">

      {loading && (
        <a
          onClick={() => setCurrentPage(currentPage + 1)}
          className="text-textBlack py-3 px-5 border-2 cursor-pointer hover:bg-slate-200 border-gray-700 rounded-3xl w-60 text-center font-medium text-text16 cargarMas"
        >
          {namebtn}
        </a>
      )}

    </div >
    <section>
      <div>
        <img src={appUrl + '/images/img/catalogo_1.png'} alt="doomine" className="w-full h-full hidden md:block" />
      </div>
    </section>
  </>)

}
let root = null;

if (document.getElementById("catalogoBlade")) {
  const container = document.getElementById("catalogoBlade");
  root = createRoot(container);
  root.render(<Catalogo {...container.dataset} />);
}
